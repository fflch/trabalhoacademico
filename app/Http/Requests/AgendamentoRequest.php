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
            'user_id' => '',
            'outro_recomendado_' => 'email|nullable|max:255',
            'divulgar_e_mail_' => ['required',Rule::in($agendamento->divulgaOptions()),'max:255'],
            'tipo' => ['required',Rule::in($agendamento->tipoOptions()), 'max:255'],
            'titulo' => 'required|max:255',
            'resumo' => 'required',
            'palavras_chave' => 'required|max:255',
            'titulo_ingles' => 'max:255',
            'keywords' => 'max:255',
            'abstract' => '',
            'data_da_defesa' => 'required|dateformat:d/m/Y',
            'horario' => 'required',
            'sala' => 'required',
            'nome_do_orientador' => 'max:255',
            'numero_usp_do_orientador' => 'required|integer',
            'curso' => 'max:255',
        ];
    }
    public function messages()
    {
        return [
            'divulgar_e_mail_.required' => 'Você precisa marcar se quer divulgar seu e-mail',
            'tipo.required' => 'Você precisa preencher a Modalidade de Defesa',
            'titulo.required' => 'Você precisa preencher o campo Titulo',
            'resumo.required' => 'Você precisa preencher o campo Resumo',
            'palavras_chave.required' => 'Você precisa preencher o campo Palavra Chave',
            'data_da_defesa.required' => 'Você precisa preencher a Data da Defesa',
            'horario.required' => 'Você precisa preencher o Horário da Defesa',
            'sala.required' => 'Você precisa preencher o Local da Defesa',
            'numero_usp_do_orientador.required' => 'Você precisa preencher qual o Orientador',
            'numero_usp_do_orientador.integer' => 'Orientador precisa ser inteiro'
        ];
    }
}
