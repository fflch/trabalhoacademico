<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Storage;

class FileController extends Controller
{
    
    public function store(Request $request)
    {
        $this->authorize('LOGADO');
        $request->validate([
            'file' => 'required|mimetypes:application/pdf|max:12288',
            'status' => 'required',
            'tipo' => 'required',
            'agendamento_id' => 'required|integer|exists:agendamentos,id',
        ]);
        //Primeiro deleta o arquivo anterior, caso exista
        $file_old = File::where('agendamento_id',$request->agendamento_id)->where('tipo', $request->tipo)->first();
        if($file_old){
            Storage::delete($file_old->path);
            $file_old->delete();
        }
        //Depois faz upload de novo arquivo
        $file = new File;
        $file->agendamento_id = $request->agendamento_id;
        $file->original_name = $request->file('file')->getClientOriginalName();
        $file->path = $request->file('file')->store('.');
        $file->tipo = $request->tipo;
        $file->save();
        return back();
    }

    public function show(File $file)
    {
        $this->authorize('view', $file);
        return Storage::download($file->path, $file->original_name);
    }

    public function destroy(File $file)
    {
        $this->authorize('delete',$file);
        Storage::delete($file->path);
        $file->delete();
        return back();
    }
}
