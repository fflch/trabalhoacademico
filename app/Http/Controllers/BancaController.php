<?php

namespace App\Http\Controllers;

use App\Models\Banca;
use Illuminate\Http\Request;
use App\Models\Agendamento;
use App\Http\Requests\BancaRequest;
use Uspdev\Replicado\Pessoa;

class BancaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function index()
    {
        //
    }*/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($agendamento)
    {
        //$this->authorize('admin');
        $banca = new Banca;
        return view('agendamentos.bancas.create',compact(['agendamento','banca']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BancaRequest $request, Agendamento $agendamento)
    {
        //$this->authorize('admin');
        $banca = new Banca;
        $validated = $request->validated();
        $banca->codpes = $validated['codpes'];
        $banca->nome = $validated['nome'];
        $banca->presidente = $validated['presidente'];
        $banca->agendamento_id = $agendamento->id;
        $agendamento->bancas()->save($banca);
        return redirect("/agendamentos/$agendamento->id");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banca  $banca
     * @return \Illuminate\Http\Response
     */
    /*public function show(Banca $banca)
    {
        //
    }*/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banca  $banca
     * @return \Illuminate\Http\Response
     */
    public function edit(Agendamento $agendamento, Banca $banca)
    {
        //$this->authorize('admin');
        return view('agendamentos.bancas.edit', compact(['agendamento','banca'], [$agendamento,$banca]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banca  $banca
     * @return \Illuminate\Http\Response
     */
    public function update(Agendamento $agendamento, Banca $banca, BancaRequest $request)
    {
        //$this->authorize('admin');
        $validated = $request->validated();
        $banca->update($validated);
        return redirect("/agendamentos/$agendamento->id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banca  $banca
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agendamento $agendamento, Banca $banca)
    {
        //$this->authorize('admin');
        $banca->delete();
        return redirect("/agendamentos/{$agendamento->id}");
    }
}
