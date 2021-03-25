<?php

namespace App\Http\Controllers;


use App\Models\Agendamento;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests\AgendamentoRequest;
use App\Models\Banca;
use Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmAvaliacaoMail;
use App\Mail\DevolucaoMail;
use App\Mail\AprovacaoMail;
use App\Mail\LiberacaoMail;
use App\Mail\BibliotecaMail;
use App\Mail\CorrecaoMail;
use Uspdev\Replicado\Pessoa;
use Auth;

class AgendamentoController extends Controller
{   
    public function index(Request $request)
    {        
        $this->authorize('LOGADO');
        
        $request->validate([
            'busca_data' => 'required_if:filtro_busca,data|dateformat:d/m/Y|nullable',
        ]);
        
        $query = Agendamento::join('users', 'users.id', '=', 'agendamentos.user_id')->orderBy('agendamentos.data_da_defesa', 'desc')->select('agendamentos.*'); 
        if($request->busca != ''){
            $query->where(function($query) use($request){
                $query->orWhere('users.name', 'LIKE', "%$request->busca%");
                $query->orWhere('agendamentos.nome_do_orientador', 'LIKE', "%$request->busca%");
                $query->orWhere('agendamentos.titulo', 'LIKE', "%$request->busca%");
            });
        }
        elseif($request->filtro_busca == 'data'){
            $data = Carbon::CreatefromFormat('d/m/Y', "$request->busca_data");
            $query->whereDate('data_da_defesa','=', $data);
        }
        
        $agendamentos = $query->paginate(20);
        
        if ($agendamentos->count() == null and $request->busca != '') {
            $request->session()->flash('alert-danger', 'Não há registros!');
        }
        return view('agendamentos.index')->with('agendamentos',$agendamentos);
    }

    public function create(Request $request)
    {
        $this->authorize('LOGADO');
        $agendamento = Agendamento::where('user_id', Auth::user()->id)->first();
        if($agendamento == null or ($agendamento->status == 'Aprovado' or $agendamento->status == 'Aprovado C/ Correções' or $agendamento->status == 'Reprovado')){
            $agendamento = new Agendamento;
            return view('agendamentos.create')->with('agendamento', $agendamento);
        }
        else{
            $request->session()->flash('alert-danger', 'Você já tem uma defesa em andamento!');
            return redirect('/agendamentos');
        }
    }

    public function store(AgendamentoRequest $request)
    {
        $this->authorize('LOGADO');
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

    public function show(Agendamento $agendamento)
    {
        //$this->authorize('LOGADO');
        return view('agendamentos.show', compact('agendamento'));
    }

    public function edit(Agendamento $agendamento)
    {
        $this->authorize('OWNER',$agendamento);
        return view('agendamentos.edit')->with('agendamento', $agendamento);
    }

    public function update(AgendamentoRequest $request, Agendamento $agendamento)
    {
        $this->authorize('OWNER',$agendamento);
        $validated = $request->validated();
        $validated['data_da_defesa'] = $validated['data_da_defesa']." $request->horario";
        $validated['nome_do_orientador'] = Pessoa::dump($validated['numero_usp_do_orientador'])['nompes'];
        $agendamento->update($validated);
        return redirect("/agendamentos/$agendamento->id");
    }

    
    public function destroy(Agendamento $agendamento)
    {
        $this->authorize('OWNER',$agendamento);

        $agendamento->bancas()->delete();
        $files = $agendamento->files;
        foreach($files as $file){
            Storage::delete($file->path);
        }
        $agendamento->files()->delete();
        $agendamento->delete();
        return redirect('/agendamentos');
    }

    public function enviar_avaliacao(Agendamento $agendamento){
        $this->authorize('OWNER',$agendamento);
        $agendamento->data_enviado_avaliacao = date('Y-m-d');
        $agendamento->update();
        # Mandar email para orientador
        Mail::send(new EmAvaliacaoMail($agendamento));
        return redirect('/agendamentos/'.$agendamento->id);
    }

    public function enviar_correcao(Agendamento $agendamento){
        $this->authorize('OWNER',$agendamento);
        $agendamento->data_enviado_correcao = date('Y-m-d');
        $agendamento->update();
        # Mandar email para orientador
        Mail::send(new CorrecaoMail($agendamento));
        return redirect('/agendamentos/'.$agendamento->id);
    }

    public function liberar(Agendamento $agendamento, Request $request){
        $this->authorize('DOCENTE',$agendamento);
        if($request->comentario){
            $agendamento->comentario = $request->comentario;
        }
        if($request->devolver != 'Devolver para o Aluno'){
            $agendamento->status = 'Em Avaliação';
            $agendamento->data_liberacao = date('Y-m-d');
            $agendamento->update();
            # Mandar email para orientador
            foreach($agendamento->bancas as $banca){
                if($banca->n_usp != null and Pessoa::emailusp($banca->n_usp) != false){
                    Mail::send(new LiberacaoMail($agendamento, $banca, null));
                }
                elseif($banca->prof_externo_id != null and $banca->prof_externo->email != ''){
                    Mail::send(new LiberacaoMail($agendamento, null, $banca->prof_externo));
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
        $this->authorize('DOCENTE',$agendamento);
        $request->validate([
            'parecer' => '',
            'nota' => 'required',
        ]);
        if($request->parecer){
            $agendamento->parecer = $request->parecer;
        }
        if($request->nota){
            $agendamento->nota = $request->nota;  
        }
        if($request->devolver){
            $agendamento->status = 'Aprovado C/ Correções';
            $agendamento->data_devolucao = date('Y-m-d');
            $agendamento->update();
            Mail::send(new DevolucaoMail($agendamento));
        }
        else{
            if($request->aprovar){
                $agendamento->status = 'Aprovado';
                foreach(explode(',', trim(env('CODPES_BIBLIOTECA'))) as $codpes){
                    Mail::send(new BibliotecaMail($agendamento, $codpes));
                }
            } 
            elseif($request->reprovar){
                $agendamento->status = 'Reprovado';
            }
            $agendamento->data_resultado = date('Y-m-d');
            $agendamento->update();
            Mail::send(new AprovacaoMail($agendamento));
        }
        return redirect('/agendamentos/'.$agendamento->id);
    }

    public function publicar(Agendamento $agendamento, Request $request){
        $this->authorize('BIBLIOTECA');
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
        $this->authorize('ADMIN');
        $agendamento->status = 'Em Avaliação';
        $agendamento->data_publicacao = null;
        $agendamento->url_biblioteca = '';
        $agendamento->data_resultado = null;
        $agendamento->data_devolucao = null;
        $agendamento->data_enviado_correcao = null;
        $agendamento->publicado = 'Não';
        $agendamento->update();
        return redirect('/agendamentos/'.$agendamento->id);
    }
}
