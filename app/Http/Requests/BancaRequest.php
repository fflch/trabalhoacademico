<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Agendamento;
use Illuminate\Validation\Rule;

class BancaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $agendamento = new Agendamento;
        return [
            'n_usp' => ['integer','required_without:prof_externo_id','nullable'],
            'prof_externo_id' => ['integer','required_without:n_usp','nullable'],
            'agendamento_id' => 'required|integer',
        ];
    }
    public function messages()
    {
        return [
            'n_usp.required_without' => 'O campo Docente USP precisa ser preenchido quando o campo Docente Externo não estiver preenchido',   
            'prof_externo_id.required_without' => 'O campo Docente Externo precisa ser preenchido quando o campo Docente USP não estiver preenchido',    
            'agendamento_id.required' => 'Você precisa marcar se quer divulgar seu e-mail',    
        ];
    }
}
