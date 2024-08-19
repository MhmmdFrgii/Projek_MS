<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeDeskripsiRequest extends FormRequest
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
        return [
            'judul' => 'required|string|max:20',
            'kutipan_id' => 'required|exists:kutipas,id'
        ];
    }

    public function messages(): array
    {
        return [
            'judul.required' => 'judul harus diisi',
            'judul.string' => 'judul harus berupa text',
            'judul.max' => 'maximal 20 karakter',
            'kutipan_id.required' => 'wajib memilih kutipan',
            'kutipan_id.exists' => 'kutipan yang anda pilih tidak valid'
        ];
    }
}
