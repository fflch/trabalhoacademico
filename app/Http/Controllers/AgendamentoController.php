<?php

namespace App\Http\Controllers;


use App\Models\Agendamento;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests\AgendamentoRequest;
use App\Models\Banca;
use Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmAvaliacaoMail;

class AgendamentoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $query = Agendamento::orderBy('data_da_defesa', 'desc');

        if($request->filtro_busca == 'numero_nome') {
            $query->where('codpes', '=', $request->busca);
            if($query->count() == null){
                $query->orWhere('nome', 'LIKE', "%$request->busca%");
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
        
        if ($agendamentos->count() == null) {
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
        # Mandar email para orientador
        Mail::send(new EmAvaliacaoMail($agendamento));

        return redirect('/agendamentos/'.$agendamento->id);
    }
}
