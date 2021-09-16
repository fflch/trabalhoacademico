<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfigRequest extends FormRequest
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
        return [
            'sitename' => 'required',
            'rodape_site' => 'required',
            'rodape_oficios' => 'required',
            'importante_oficio' => 'required',
            'declaracao' => 'required',
            'mail_avaliacao' => 'required',
            'mail_liberacao' => 'required',
            'mail_devolucao' => 'required',
            'mail_aprovacao' => 'required',
            'mail_correcao' => 'required',
            'mail_envio_correcao_remember' => 'required',
        ];
    }
}
