<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->id),
            ],
            'user_type' => 'required|in:A,E',
            'address' => 'sometimes',
            'nif' => 'sometimes',
            'default_payment_type' => 'sometimes|in:VISA,MC,PAYPAL',
            'default_payment_ref' => 'sometimes',
            'password_inicial' =>   'sometimes|required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' =>  'The name is required',
            'email.required' => 'The email is required',
            'email.email' =>    'The email format is not valid',
            'email.unique' =>   'The email must be unique',
            'default_payment_type.in' => 'Payment type must be: VISA, MC or PAYPAL',
            'password_inicial.required' => 'Initial password is mandatory'
        ];
    }
}
