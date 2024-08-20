<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSiswaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Izinkan semua pengguna untuk menggunakan request ini
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
{
    $siswaId = $this->route('siswa') ? $this->route('siswa')->id : null;

        $rules = [
            'nis' => [
                'required',
                'unique:siswa,nis,' . $siswaId, // Mengabaikan unique jika ID siswa sama
                'regex:/^[a-zA-Z0-9]+$/'
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z\s]+$/'
            ],
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|string|max:255',
            'phone' => 'required|numeric|unique:siswa,phone,' . $siswaId, // Mengabaikan unique jika ID siswa sama
            'email' => 'required|email|unique:siswa,email,' . $siswaId, // Mengabaikan unique jika ID siswa sama
            'id_kelas' => 'required|exists:tb_kelas,id_kelas',
            'id_jurusan' => 'required|exists:tb_jurusan,id_jurusan',
            'id_organisasi' => 'nullable|exists:tb_organisasi,id_organisasi',
            'id_ekskul' => 'nullable|exists:tb_ekskul,id_ekskul',
            'alamat' => 'required|string|max:500',
        ];

        return $rules;


    }

    /**
     * Get the custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nis.required' => 'NIS wajib diisi.',
            'nis.unique' => 'NIS sudah terdaftar.',
            'nis.regex' => 'NIS hanya boleh berisi huruf dan angka.',
            'image.required' => 'Foto harus diisi.',
            'image.image' => 'File foto harus berformat jpg, png, gif, atau svg.',
            'image.max' => 'Ukuran maksimal foto adalah 2 MB.',
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama maksimal 255 karakter.',
            'nama.regex' => 'Nama hanya boleh berisi huruf.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
            'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan.',
            'phone.required' => 'Nomor HP wajib diisi.',
            'phone.numeric' => 'Nomor HP hanya boleh berisi angka.',
            'phone.unique' => 'Nomor HP sudah terdaftar.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Masukkan email yang valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'agama.required' => 'Agama wajib diisi.',
            'agama.string' => 'Agama harus berupa teks.',
            'agama.max' => 'Agama maksimal 255 karakter.',
            'id_kelas.required' => 'Kelas wajib diisi.',
            'id_kelas.exists' => 'Kelas tidak valid.',
            'id_jurusan.required' => 'Jurusan wajib diisi.',
            'id_jurusan.exists' => 'Jurusan tidak valid.',
            'id_organisasi.exists' => 'Organisasi tidak valid.',
            'id_ekskul.exists' => 'Ekskul tidak valid.',
            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.string' => 'Alamat harus berupa teks.',
            'alamat.max' => 'Alamat maksimal 500 karakter.',
        ];
    }
}
