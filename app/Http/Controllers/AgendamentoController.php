<?php

namespace App\Http\Controllers;


use App\Models\Agendamento;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests\AgendamentoRequest;
use App\Models\Banca;
use Storage;
use Uspdev\Replicado\Pessoa;
use Auth;
use App\Models\File;
use App\Jobs\EmAvaliacaoJob;
use App\Jobs\LiberacaoJob;
use App\Jobs\DevolucaoJob;
use App\Jobs\BibliotecaJob;
use App\Jobs\AprovacaoJob;
use App\Jobs\CorrecaoJob;
use App\Jobs\DeclaracaoJob;
use Fflch\LaravelFflchStepper\Stepper;

class AgendamentoController extends Controller
{   
    public function index(Request $request)
    {        
        $this->authorize('logado');
        
        $agendamentos = $this->search($request);
        
        if ($agendamentos->count() == null and $request->busca != '') {
            $request->session()->flash('alert-danger', 'Não há registros!');
        }
        return view('agendamentos.index')->with('agendamentos',$agendamentos);
    }

    public function search(Request $request){
        $request->validate([
            'busca_data' => 'required_if:filtro_busca,data|dateformat:d/m/Y|nullable',
        ]);
        
        $query = Agendamento::join('users', 'users.id', '=', 'agendamentos.user_id')->orderBy('agendamentos.data_da_defesa', 'desc')->select('agendamentos.*'); 
        if($request->busca != ''){
            $query->where(function($query) use($request){
                $query->orWhere('users.name', 'LIKE', "%$request->busca%");
                $query->orWhere('users.codpes', '=', "$request->busca");
                $query->orWhere('agendamentos.nome_do_orientador', 'LIKE', "%$request->busca%");
                $query->orWhere('agendamentos.titulo', 'LIKE', "%$request->busca%");
            });
        }
        elseif($request->filtro_busca == 'data'){
            $data = Carbon::CreatefromFormat('d/m/Y', "$request->busca_data");
            $query->whereDate('data_da_defesa','=', $data);
        }
        if($request->busca_status != ''){
            $query->where('status','=', $request->busca_status);
        }
        return $query->paginate(20);
    }

    public function create(Request $request)
    {
        $this->authorize('logado');
        $agendamento = Agendamento::where('user_id', Auth::user()->id)->first();
        if($agendamento == null or ($agendamento->status == 'Aprovado' or $agendamento->status == 'Aprovado C/ Correções' or $agendamento->status == 'Reprovado')){
            $agendamento = new Agendamento;
            return view('agendamentos.create')->with('agendamento', $agendamento);
        }
        
        $request->session()->flash('alert-danger', 'Você já tem uma defesa em andamento!'); 
        return redirect('/agendamentos');
    }

    public function store(AgendamentoRequest $request)
    {
        $this->authorize('logado');
        $validated = $request->validated();
        $validated['data_da_defesa'] = $validated['data_da_defesa']." $request->horario";
        $validated['nome_do_orientador'] = Pessoa::dump($validated['numero_usp_do_orientador'])['nompes'];
        $validated['publicado'] = 'Não';
        $validated['status'] = 'Em Elaboração';
        $agendamento = Agendamento::create($validated);
        //Salva o orientador na banca
        $banca = new Banca;
        $banca->n_usp = $validated['numero_usp_do_orientador'];
        $banca->presidente = 'Sim'; 
        $banca->agendamento_id = $agendamento->id;
        $agendamento->bancas()->save($banca);
        return redirect("/agendamentos/$agendamento->id");
    }

    public function show(Agendamento $agendamento, Stepper $stepper)
    {
        if($agendamento->data_liberacao == null and $agendamento->data_enviado_avaliacao != null){
            $stepper->setCurrentStepName('Em Análise');
        }
        elseif($agendamento->publicado == 'Sim'){
            $stepper->setCurrentStepName('Publicação');
        }
        else{
            $stepper->setCurrentStepName($agendamento->status);
        }
        $dias = Carbon::now()->diff($agendamento->data_da_defesa)->days;
        
        if(!auth()->check()) return redirect('/');

        if(auth()->check() or in_array($agendamento->status,['Em Avaliação', 'Aprovado', 'Aprovado C/ Correções'])){
            return view('agendamentos.show')->with([
                'agendamento' => $agendamento,
                'dias' => $dias,
                'stepper' => $stepper->render(),
            ]);
        }
    }

    public function edit(Agendamento $agendamento)
    {
        $this->authorize('owner',$agendamento);
        return view('agendamentos.edit')->with('agendamento', $agendamento);
    }

    public function update(AgendamentoRequest $request, Agendamento $agendamento)
    {
        $this->authorize('owner',$agendamento);
        $validated = $request->validated();
        $validated['data_da_defesa'] = $validated['data_da_defesa']." $request->horario";
        $validated['nome_do_orientador'] = Pessoa::dump($validated['numero_usp_do_orientador'])['nompes'];
        $agendamento->setCursoAttribute($validated['curso']);
        $agendamento->update($validated);
        return redirect("/agendamentos/$agendamento->id");
    }
    
    public function destroy(Agendamento $agendamento, Request $request)
    {
        $this->authorize('owner',$agendamento);
        if($agendamento->status == 'Em Elaboração'){
            $agendamento->bancas()->delete();
            $files = $agendamento->files;
            foreach($files as $file){
                Storage::delete($file->path);
            }
            $agendamento->files()->delete();
            $agendamento->delete();
        }
        $request->session()->flash('alert-danger', 'Você não pode excluir uma defesa em andamento!');
        return redirect('/agendamentos');
    }

    public function enviar_avaliacao(Agendamento $agendamento){
        $this->authorize('owner',$agendamento);
        $agendamento->data_enviado_avaliacao = date('Y-m-d');
        $agendamento->update();
        # Mandar email para orientador
        EmAvaliacaoJob::dispatch($agendamento);
        return redirect('/agendamentos/'.$agendamento->id);
    }

    public function enviar_correcao(Agendamento $agendamento, Request $request){
        $this->authorize('owner',$agendamento);
        $dias = Carbon::now()->diff($agendamento->data_da_defesa)->days;
        if($agendamento->files()->where('tipo', 'trabalho')->count() != 0){
            $agendamento->data_enviado_correcao = date('Y-m-d');
            $agendamento->status = 'Em Avaliação';
            $agendamento->update();
            # Mandar email para orientador
            CorrecaoJob::dispatch($agendamento);
        }
        else{
            $request->session()->flash('alert-danger', 'Não foi possível enviar o trabalho corrigido! Verifique se foi feito o upload do arquivo corrigido ou se está dentro do prazo e tente novamente.');
        }
        
        return redirect('/agendamentos/'.$agendamento->id);
    }

    public function liberar(Agendamento $agendamento, Request $request){
        $this->authorize('docente',$agendamento);
        if($request->comentario){
            $agendamento->comentario = $request->comentario;
        }
        if($request->devolver != 'Devolver para o Aluno'){
            $agendamento->status = 'Em Avaliação';
            $agendamento->data_liberacao = date('Y-m-d');
            $agendamento->update();
            //Mandar email para orientador
            foreach($agendamento->bancas as $banca){
                if($banca->n_usp != null or $banca->prof_externo_id != null){
                    LiberacaoJob::dispatch($agendamento, $banca);
                }
            }
        }
        else{
            $agendamento->status = 'Em Elaboração';
            $agendamento->data_enviado_avaliacao = null;
            $agendamento->update();
        }
        return redirect('/agendamentos/'.$agendamento->id);
    }

    public function resultado(Agendamento $agendamento, Request $request){
        $this->authorize('docente',$agendamento);
        $request->validate([
            'parecer' => '',
            'nota' => 'required',
        ]);
        if($request->parecer){
            $agendamento->parecer = $request->parecer;
        }
        $agendamento->nota = $request->nota;  
        if($request->devolver){
            $agendamento->status = 'Aprovado C/ Correções';
            $agendamento->data_devolucao = date('Y-m-d');
            $agendamento->update();
            DevolucaoJob::dispatch($agendamento);
        }
        else{
            if($request->aprovar){
                $agendamento->status = 'Aprovado';
                foreach(explode(',', trim(env('CODPES_BIBLIOTECA'))) as $codpes){
                    if($codpes != false){
                        BibliotecaJob::dispatch($agendamento, $codpes);
                    }
                }
            } 
            elseif($request->reprovar){
                $agendamento->status = 'Reprovado';
            }
            $agendamento->data_resultado = date('Y-m-d');
            $agendamento->update();
            AprovacaoJob::dispatch($agendamento);
        }
        foreach($agendamento->bancas as $banca){
            if($banca->n_usp != null or $banca->prof_externo_id != null){
                DeclaracaoJob::dispatch($agendamento, $banca);
            }
        }
        return redirect('/agendamentos/'.$agendamento->id);
    }

    public function publicar(Agendamento $agendamento, Request $request){
        $this->authorize('biblioteca');
        $request->validate([
            'url_biblioteca' => 'required_if:publicado,Sim|nullable',
            'publicado' => 'required',
        ]);
        $agendamento->data_publicacao = date('Y-m-d');
        $agendamento->url_biblioteca = $request->url_biblioteca;
        $agendamento->publicado = $request->publicado;
        $agendamento->update();
        return redirect('/agendamentos/'.$agendamento->id);
    }

    public function voltar_defesa(Agendamento $agendamento){
        $this->authorize('admin');
        if($agendamento->status == 'Aprovado' or $agendamento->status == 'Aprovado C/ Correções' or $agendamento->status == 'Reprovado'){
            $agendamento->status = 'Em Avaliação';
            $agendamento->data_publicacao = null;
            $agendamento->url_biblioteca = '';
            $agendamento->data_resultado = null;
            $agendamento->data_devolucao = null;
            $agendamento->data_enviado_correcao = null;
            $agendamento->publicado = 'Não';
        }
        elseif($agendamento->status == 'Em Avaliação'){
            $agendamento->status = 'Em Elaboração';
            $agendamento->data_liberacao = null;
        }
        elseif($agendamento->status == 'Em Elaboração' && $agendamento->data_enviado_avaliacao != null){
            $agendamento->data_enviado_avaliacao = null;
        }
        $agendamento->update();
        return redirect('/agendamentos/'.$agendamento->id);
    }

    public function acesso_autorizado(Request $request)
    {
        if ($request->hasValidSignature()) {
            $file = File::find($request->file_id);

            if ($file) {
                return Storage::download($file->path, $file->original_name);
            }
            else{
                $file = File::where('agendamento_id', $request->agendamento_id)->orderBy('created_at', 'desc')->first();
                return Storage::download($file->path, $file->original_name);
            }
        }

        $request->session()->flash('alert-danger', "URL expirada!");
        return redirect('/');
    }  
}
