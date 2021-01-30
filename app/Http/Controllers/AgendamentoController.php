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
use Uspdev\Replicado\Pessoa;

class AgendamentoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $request->validate([
            'busca_data' => 'required_if:filtro_busca,data',
        ]);
        $query = Agendamento::orderBy('data_da_defesa', 'desc');
        $query2 = User::orderBy('name');
        if($request->filtro_busca == 'numero_nome' and $request->busca != '') {
            $query2->where('codpes', '=', $request->busca);
            if($query2->count() == null){
                $query2->orWhere('name', 'LIKE', "%$request->busca%");
            }
            foreach($query2->get() as $user){
                $query->orWhere('user_id',$user->id);
            }
        } 
        elseif($request->filtro_busca == 'data'){
            $request->validate([
                'busca_data' => 'required|dateformat:d/m/Y',
            ]);
            $data = Carbon::CreatefromFormat('d/m/Y', "$request->busca_data");
            $query->whereDate('data_da_defesa','=', $data);
        }
        
        $agendamentos = $query->paginate(20);
        
        if ($agendamentos->count() == null and $request->busca != '') {
            $request->session()->flash('alert-danger', 'Não há registros!');
        }
        return view('agendamentos.index')->with('agendamentos',$agendamentos);
    }

    public function create()
    {
        $agendamento = new Agendamento;
        return view('agendamentos.create')->with('agendamento', $agendamento);
    }

    public function store(AgendamentoRequest $request)
    {
        $validated = $request->validated();
        $validated['nome_do_orientador'] = Pessoa::dump($validated['numero_usp_do_orientador'])['nompes'];
        $agendamento = Agendamento::create($validated);
        //Salva o orientador na banca
        $banca = new Banca;
        $banca->codpes = $validated['numero_usp_do_orientador'];
        $banca->nome = $validated['nome_do_orientador'];
        $banca->presidente = 'Sim'; 
        $banca->agendamento_id = $agendamento->id;
        $agendamento->bancas()->save($banca);
        return redirect("/agendamentos/$agendamento->id");
    }

    public function show(Agendamento $agendamento)
    {
        return view('agendamentos.show', compact('agendamento'));
    }

    public function edit(Agendamento $agendamento)
    {
        return view('agendamentos.edit')->with('agendamento', $agendamento);
    }

    public function update(AgendamentoRequest $request, Agendamento $agendamento)
    {
        $validated = $request->validated();
        $validated['nome_do_orientador'] = Pessoa::dump($validated['numero_usp_do_orientador'])['nompes'];
        $agendamento->update($validated);
        return redirect("/agendamentos/$agendamento->id");
    }

    
    public function destroy(Agendamento $agendamento)
    {
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
        $agendamento->status = 'Em Avaliação';
        $agendamento->data_enviado_avaliacao = date('Y-m-d');
        $agendamento->update();
        # Mandar email para orientador
        Mail::send(new EmAvaliacaoMail($agendamento));
        return redirect('/agendamentos/'.$agendamento->id);
    }
}
