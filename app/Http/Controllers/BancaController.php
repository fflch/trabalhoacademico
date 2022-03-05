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
    
    public function store(BancaRequest $request)
    {
        $this->authorize('logado');
        $validated = $request->validated();
        $validated['presidente'] = 'Não';
        Banca::create($validated);
        return back();
    }

    public function destroy(Banca $banca)
    {
        $this->authorize('logado');
        $banca->delete();
        return back();
    }
}
