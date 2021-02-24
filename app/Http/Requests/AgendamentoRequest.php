<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Agendamento;

class AgendamentoRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $agendamento = new Agendamento;
        return [
            'user_id' => 'required|integer',
            'outro_recomendado_' => 'email|nullable',
            'divulgar_e_mail_' => ['required',Rule::in($agendamento->divulgaOptions())],
            'titulo' => 'required',
            'resumo' => 'required', 
            'palavras_chave' => 'required',
            'titulo_ingles' => '',
            'keywords' => '',
            'abstract' => '',
            'data_da_defesa' => 'required|dateformat:d/m/Y',
            'horario' => 'required',
            'sala' => 'required',
            'nome_do_orientador' => '',
            'numero_usp_do_orientador' => 'required|integer',
            'status' => '',
            'curso' => '',
        ];
    }
}
