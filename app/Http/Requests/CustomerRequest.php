<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
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
            // 'user_type' => 'required|in:A,E,C',
            'address' => 'sometimes',
            'nif' => 'sometimes|digits:9',
            'default_payment_type' => 'sometimes|in:VISA,MC,PAYPAL',
            'default_payment_ref' => [
                'sometimes',
                Rule::requiredIf(function () {
                    return in_array($this->input('default_payment_type'), ['VISA', 'MC']);
                }),
                Rule::requiredIf(function () {
                    return $this->input('default_payment_type') === 'PAYPAL';
                }),
                function ($attribute, $value, $fail) {
                    $defaultPaymentType = $this->input('default_payment_type');
                    if ($defaultPaymentType === 'VISA' || $defaultPaymentType === 'MC') {
                        if (!preg_match('/^\d{16}$/', $value)) {
                            $fail('The default payment reference must be a 16-digit number.');
                        }
                    } elseif ($defaultPaymentType === 'PAYPAL') {
                        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                            $fail('The default payment reference must be a valid email address.');
                        }
                    }
                }
            ],
            'file_foto' => 'sometimes|image|max:4096', // maxsize = 4Mb
            'password_inicial' => 'sometimes|required',
        ];
    }
}
