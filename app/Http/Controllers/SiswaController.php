<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\Organisasi;
use App\Models\Ekskul;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        // $query = Siswa::query()->where('tgl_masuk','>', now());
        $query = Siswa::query();
        $key = $request->get('key');

        // if ($request->has('key')) {
        //     $key = $request->get('key');
        //     $query->where(function ($q) use ($key) {
        //         $q->where('nama', 'like', "%{$key}%");
        //     });
        // }

        if ($key)
        {
            $query->where('nama', 'like', "%{$key}%")->orWhere('nis', 'like', "%{$key}%");
        }


        $siswa = $query->orderBy('created_at', 'desc')->paginate(5)->withQueryString();

        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        $organisasi = Organisasi::all();
        $ekskul = Ekskul::all();

        $message = $siswa->isEmpty() ? 'Data tidak ditemukan' : '';

        return view('siswa.index', compact('siswa', 'kelas', 'jurusan', 'organisasi', 'ekskul', 'message', 'key'));
    }



    public function create()
    {
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        $organisasi = Organisasi::all();
        $ekskul = Ekskul::all();
        return view('siswa.create', compact('kelas', 'jurusan', 'organisasi', 'ekskul'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nis' => ['required', 'unique:siswa,nis', 'regex:/^[a-zA-Z0-9]+$/'],
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'nama' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'agama' => 'required|string|max:255',
                'phone' => 'required|numeric|unique:siswa,phone',
                'email' => 'required|email|unique:siswa,email',
                'id_kelas' => 'required|exists:tb_kelas,id_kelas',
                'id_jurusan' => 'required|exists:tb_jurusan,id_jurusan',
                'id_organisasi' => 'nullable|exists:tb_organisasi,id_organisasi',
                'id_ekskul' => 'nullable|exists:tb_ekskul,id_ekskul',
                'alamat' => 'required|string|max:500',
            ],
            [
                'nis.required' => 'NIS wajib diisi.',
                'nis.unique' => 'NIS sudah terdaftar.',
                'nis.regex' => 'NIS hanya boleh berisi huruf dan angka.',
                'image.required' => 'Foto harus diisi',
                'image.image' => 'File foto harus berformat jpg,png dan svg.',
                'image.max' => 'Maximal ukuran foto 2048 MB.',
                'nama.required' => 'Nama wajib diisi.',
                'nama.string' => 'Nama harus berupa teks.',
                'nama.max' => 'Nama maksimal 255 karakter.',
                'nama.regex' => 'Nama hanya boleh berisi huruf.',
                'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
                'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan.',
                'phone.required' => 'No hp wajib diisi.',
                'phone.numeric' => 'No hp hanya boleh berisi angka.',
                'phone.unique' => 'No hp sudah terdaftar.',
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
            ]
        );

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = $imagePath;
        }

        Siswa::create($data);

        return redirect()->route('siswa.index')->with('status', 'Data siswa berhasil disimpan!');
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        $organisasi = Organisasi::all();
        $ekskul = Ekskul::all();
        return view('siswa.edit', compact('siswa', 'kelas', 'jurusan', 'organisasi', 'ekskul'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'nis' => ['required', 'unique:siswa,nis,' . $id, 'regex:/^[a-zA-Z0-9]+$/'],
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'nama' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'agama' => 'required|string|max:255',
                'phone' => ['required', 'unique:siswa,phone,' . $id, 'regex:/^[0-9]+$/'],
                'email' => ['required', 'email', 'unique:siswa,email,' . $id],
                'id_kelas' => 'required|exists:tb_kelas,id_kelas',
                'id_jurusan' => 'required|exists:tb_jurusan,id_jurusan',
                'id_organisasi' => 'nullable|exists:tb_organisasi,id_organisasi',
                'id_ekskul' => 'nullable|exists:tb_ekskul,id_ekskul',
                'alamat' => 'required|string|max:500',
            ],
            [
                'nis.required' => 'NIS wajib diisi.',
                'nis.unique' => 'NIS sudah terdaftar.',
                'nis.regex' => 'NIS hanya boleh berisi huruf dan angka.',
                'image.image' => 'File foto harus berformat jpg,png dan svg.',
                'image.max' => 'Maximal ukuran foto 2048 MB.',
                'nama.required' => 'Nama wajib diisi.',
                'nama.string' => 'Nama harus berupa teks.',
                'nama.max' => 'Nama maksimal 255 karakter.',
                'nama.regex' => 'Nama hanya boleh berisi huruf.',
                'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
                'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan.',
                'phone.required' => 'No hp harus diisi.',
                'phone.regex' => 'No hp tidak valid.',
                'phone.unique' => 'No hp sudah terdaftar.',
                'email.required' => 'Email harus diisi.',
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
            ]
        );

        $siswa = Siswa::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($siswa->image) {
                Storage::delete('public/' . $siswa->image);
            }
            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = $imagePath;
        }

        $siswa->update($data);

        return redirect()->route('siswa.index')->with('status', 'Data siswa berhasil diupdate!');
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        if ($siswa->image) {
            Storage::delete('public/' . $siswa->image);
        }

        $siswa->delete();

        return redirect()->route('siswa.index')->with('status', 'Data siswa berhasil dihapus!');
    }
}
