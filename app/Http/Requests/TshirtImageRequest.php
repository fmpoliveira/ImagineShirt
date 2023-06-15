<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TshirtImageRequest extends FormRequest
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


    public function storeRules(): array
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'tshirt_image' => 'required|image|max:4096',
            'category' => 'nullable',
        ];
    }

    /**
     * Get the validation rules that apply to the request for updating an existing T-shirt image.
     *
     * @return array
     */
    public function updateRules(): array
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'tshirt_image' => 'nullable|image|max:4096',
            'category' => 'required',
        ];
    }

    public function rules(): array
    {
        if ($this->isMethod('POST')) {
            return $this->storeRules();
        } elseif ($this->isMethod('PUT')) {
            return $this->updateRules();
        }

        return [];
    }
}
