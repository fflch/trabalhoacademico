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
            'codpes' => "integer|required_if:nome,null|nullable",
            'nome' => '',
            'agendamento_id' => 'required|integer',
        ];
    }
}
