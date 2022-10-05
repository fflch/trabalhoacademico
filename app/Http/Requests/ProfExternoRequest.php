<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfExternoRequest extends FormRequest
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

    public function rules()
    {
        $rules = [
            'nome' => 'required',
            'rg' => '',
            'cpf' => ['cpf'],
            'endereco' => '',
            'bairro' => '',
            'cep' => '',
            'cidade' => '',
            'estado' => '',
            'pais' => '',
            'telefone' => '',
            'instituicao' => 'required',
            'email' => '',
        ];
        if ($this->method() == 'PATCH' || $this->method() == 'PUT'){
            array_push($rules['cpf'], 'unique:prof_externos,cpf,'.$this->id);

        }
        else{
            array_push($rules['cpf'], 'unique:prof_externos');
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'nome.required' => 'Você precisa preencher o campo Nome',   
            'instituicao.required' => 'Você precisa marcar qual a Instituição',    
        ];
    }
    
    public function validationData()
    {
        $data = $this->all();
        $data['cpf'] = preg_replace('/[^0-9]/', '', $data['cpf']);
        return $data;
    }
}
