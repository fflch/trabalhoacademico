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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BancaRequest $request)
    {
        //$this->authorize('admin');
        $validated = $request->validated();
        Banca::create($validated);
        return back();
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
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banca  $banca
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banca  $banca
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banca $banca)
    {
        //$this->authorize('admin');
        $banca->delete();
        return back();
    }
}
