<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DisciplinaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'curso' => 'required|exists:cursos,abreviatura',
            'ano' => 'required|integer|between:1,3',
            'semestre' => 'required|in:0,1,2',
            'abreviatura' => 'required|string|max:20',
            'nome' => 'required',
            'ECTS' => 'required|integer|between:1,100',
            'horas' => 'required|integer|between:1,1000',
            'opcional' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'curso.required' => 'O curso é obrigatório',
            'curso.exists' => 'O curso não existe na base de dados',
            'ano.required' => 'O ano é obrigatório',
            'ano.integer' => 'O ano deve ser um nº inteiro',
            'ano.between' => 'O ano tem que ser entre 1 e 3',
            'semestre.required' => 'O semestre é obrigatório',
            'semestre.in' => 'O semestre tem que ser 1, 2 ou 0 (anual)',
            'abreviatura.required' => 'A abreviatura é obrigatória',
            'abreviatura.string' => 'A abreviatura tem que ser uma string',
            'abreviatura.max' => 'A abreviatura pode ter no máximo 20 caracteres',
            'nome.required' => 'A nome é obrigatório',
            'ECTS.required' => 'O nº de ECTS é obrigatório',
            'ECTS.integer' => 'O nº de ECTS deve ser um nº inteiro',
            'ECTS.between' => 'O nº de ECTS tem que ser entre 1 e 100',
            'horas.required' => 'O nº de horas é obrigatório',
            'horas.integer' => 'O nº de horas deve ser um nº inteiro',
            'horas.between' => 'O nº de horas tem que ser entre 1 e 1000',
            'opcional.required' => 'O campo "opcional" é obrigatório',
            'opcional.boolean' => 'O campo "opcional" tem que ser um booleano',
        ];
    }
}
