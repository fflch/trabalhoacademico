<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Agendamento;
use Illuminate\Validation\Rule;

class BancaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $agendamento = new Agendamento;
        return [
            'codpes' => 'required|integer',
            'nome' => 'required',
            'presidente' => ['required',Rule::in($agendamento->presidenteOptions())],
            'agendamento_id' => 'required|integer',
        ];
    }
}
