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
            'presidente' => '',
            'agendamento_id' => 'required|integer',
        ];
    }
}
