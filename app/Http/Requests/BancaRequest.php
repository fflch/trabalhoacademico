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
            'n_usp' => ['integer|required_if:prof_externo_id,null|nullable', Rule::in($agendamento->docentes())],
            'prof_externo_id' => [Rule::in($agendamento->profExterno())],
            'presidente' => '',
            'agendamento_id' => 'required|integer',
        ];
    }
}
