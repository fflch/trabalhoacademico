<?php

namespace App\Http\Controllers;

use App\Models\ProfExterno;
use Illuminate\Http\Request;
use App\Http\Requests\ProfExternoRequest;
use Auth;

class ProfExternoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('ADMIN');
        $query = ProfExterno::orderBy('nome','asc');

        if($request->busca != null){
            $query->where('nome', 'LIKE', "%$request->busca%");
        }
        $profExternos = $query->paginate(50);
        if ($profExternos->count() == null) {
            $request->session()->flash('alert-danger', 'Não há registros!');
        }
        return view('prof_externo.index')->with('profExternos',$profExternos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->authorize('ADMIN');
        $profExterno = new ProfExterno;
        return view('prof_externo.create')->with('profExterno', $profExterno);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfExternoRequest $request)
    {
        //
        $this->authorize('ADMIN');
        $validated = $request->validated();
        $validated['last_user'] = Auth::user()->codpes;
        $profExterno = ProfExterno::create($validated);
        return redirect("/prof_externo/$profExterno->id");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProfExterno  $profExterno
     * @return \Illuminate\Http\Response
     */
    public function show(ProfExterno $profExterno)
    {
        //
        $this->authorize('ADMIN');
        return view('prof_externo.show', compact('profExterno'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProfExterno  $profExterno
     * @return \Illuminate\Http\Response
     */
    public function edit(ProfExterno $profExterno)
    {
        //
        $this->authorize('ADMIN');
        return view('prof_externo.edit')->with('profExterno', $profExterno);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProfExterno  $profExterno
     * @return \Illuminate\Http\Response
     */
    public function update(ProfExternoRequest $request, ProfExterno $profExterno)
    {
        //
        $this->authorize('ADMIN');
        $validated = $request->validated();
        $validated['last_user'] = Auth::user()->codpes;
        $profExterno->update($validated);
        return redirect("/prof_externo/$profExterno->id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProfExterno  $profExterno
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProfExterno $profExterno)
    {
        //
        $this->authorize('ADMIN');
        $profExterno->delete();
        return redirect('/prof_externo');
    }
}
