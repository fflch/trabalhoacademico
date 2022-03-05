<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;
use App\Http\Requests\ConfigRequest;

class ConfigController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function edit()
    {
        $this->authorize('admin');
        $config = Config::orderByDesc('created_at')->first();
        if(!$config) $config =  new Config;
        return view('configs.edit', compact('config'));
    }

    public function store(ConfigRequest $request)
    {
        $this->authorize('admin');
        $validated = $request->validated();
        Config::create($validated);
        return redirect('/configs');
    }
}
