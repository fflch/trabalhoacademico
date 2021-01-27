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
            'codpes' => 'required|integer',
            'nome' => 'required',
            'e_mail_usp' => 'required|email',
            'outro_recomendado_' => 'email|nullable',
            'divulgar_e_mail_' => ['required',Rule::in($agendamento->divulgaOptions())],
            'titulo' => 'required',
            'resumo' => 'required', 
            'palavras_chave' => 'required',
            'abstract' => '',
            'data_da_defesa' => 'required|dateformat:d/m/Y',
            'nome_do_orientador' => 'required',
            'numero_usp_do_orientador' => 'required|integer',
            'co_orientador' => ['required',Rule::in(['Sim','Não'])],
            'status' => ['required',Rule::in($agendamento->statusOptions())],
        ];
    }
}
