<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeProdukRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'nama' => 'required|string|max:20',
            'kategori_id' => 'required|exists:kategori,id',
            'harga' => 'required|numeric',
        ];

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules = [
                'nama' => 'required|string|max:25',
            ];
        }
        return $rules;
    }

    public function messages(): array 
    {
        return [
            'nama.required' => '..',
            'nama.required' => '..',
        ];
    }
}
