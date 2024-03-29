<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class ColorRequest extends FormRequest
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
        // When i'm creating a new color, this->color doesn't exist so == null.
        // This way it doesn't run the ignore method and therefore I can create new colors
        $colorCode = $this->color ? $this->color->code : null;

        return [
            'code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('colors', 'code')->ignore($colorCode, 'code'),
            ],
            'name' => 'required',
        ];
    }
}
