<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TshirtImagePrivateRequest extends FormRequest
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
        $rules = [
            'name' => 'required',
            'description' => 'required',
        ];

        if ($this->isMethod('post')) {
            // Image is required in the store form
            $rules['tshirt_image'] = 'required|image|max:4096';
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            // Image is not required in the update form
            $rules['tshirt_image'] = 'sometimes|image|max:4096';
        }

        return $rules;
    }
}
