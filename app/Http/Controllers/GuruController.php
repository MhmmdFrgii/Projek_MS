<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\GuruJurusan;
use App\Models\GuruMapel;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\GuruKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $query = Guru::query();
        $key = $request->get('key');

        if ($request->has('key')) {
            $key = $request->get('key');
            $query->where('nama', 'like', "%{$key}%");
        }

        $guru = $query->orderBy('created_at', 'desc')->paginate(2)->withQueryString();
       $mapel = Mapel::all();
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        return view('guru.index', compact('guru', 'mapel', 'kelas', 'jurusan'));
    }

    public function create()
    {
        $mapel = Mapel::all();
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        return view('guru.create', compact('mapel', 'kelas', 'jurusan'));
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'nuptk' => ['required', 'unique:guru,nuptk', 'regex:/^[a-zA-Z0-9]+$/'],
            'nama' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|string|max:255',
            'phone' => ['required', 'unique:guru,phone', 'regex:/^[0-9]+$/'],
            'email' => ['required', 'email', 'unique:guru,email'],
            'id_mapel' => 'required|array',
            'id_mapel.*' => 'exists:tb_mapel,id_mapel',
            'id_kelas' => 'required|array',
            'id_kelas.*' => 'exists:tb_kelas,id_kelas',
            'id_jurusan' => 'required|array',
            'id_jurusan.*' => 'exists:tb_jurusan,id_jurusan',
        ], [
            'nuptk.required' => 'Nuptk wajib diisi.',
            'nuptk.unique' => 'Nuptk sudah terdaftar.',
            'nuptk.regex' => 'Nuptk hanya boleh berisi huruf dan angka.',
            'image.required' => 'Foto wajib diisi.',
            'image.image' => 'File gambar harus berformat jpg, png, dan svg.',
            'image.max' => 'Ukuran maksimal file adalah 2048 KB.',
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama maksimal 255 karakter.',
            'nama.regex' => 'Nama hanya boleh berisi huruf.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
            'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan.',
            'agama.required' => 'Agama wajib diisi.',
            'agama.string' => 'Agama harus berupa teks.',
            'agama.max' => 'Agama maksimal 255 karakter.',
            'phone.required' => 'No HP wajib diisi.',
            'phone.unique' => 'No HP sudah terdaftar.',
            'phone.regex' => 'No HP harus berupa angka.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah terdaftar.',
            'email.email' => 'Email tidak valid.',
            'id_mapel.required' => 'Mapel wajib diisi.',
            'id_mapel.exists' => 'Mapel tidak valid.',
            'id_kelas.required' => 'Kelas wajib diisi.',
            'id_kelas.exists' => 'Kelas tidak valid.',
            'id_jurusan.required' => 'Jurusan wajib diisi.',
            'id_jurusan.exists' => 'Jurusan tidak valid.',
        ]);

        // Ambil semua data request, kecuali relasi Many-to-Many
        $data = $request->except(['id_mapel', 'id_kelas', 'id_jurusan']);

        // Handle upload gambar
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = $imagePath;
        }

        // Simpan data guru
        $guru = Guru::create($data);

        // Simpan relasi dengan mapel, kelas, dan jurusan
        $guru->mapel()->sync($request->id_mapel);
        $guru->kelas()->sync($request->id_kelas);
        $guru->jurusan()->sync($request->id_jurusan);

        return redirect()->route('guru.index')->with('status', 'Data guru berhasil disimpan!');
    }

    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        $mapel = Mapel::all();
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        return view('guru.edit', compact('guru', 'mapel', 'kelas', 'jurusan'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $request->validate([
            'nuptk' => ['required', 'unique:guru,nuptk,' . $id, 'regex:/^[a-zA-Z0-9]+$/'],
            'nama' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|string|max:255',
            'phone' => ['required', 'unique:guru,phone,' . $id, 'regex:/^[0-9]+$/'],
            'email' => ['required', 'email', 'unique:guru,email,' . $id],
            'id_mapel' => 'required|array',
            'id_mapel.*' => 'exists:tb_mapel,id_mapel',
            'id_kelas' => 'required|array',
            'id_kelas.*' => 'exists:tb_kelas,id_kelas',
            'id_jurusan' => 'required|array',
            'id_jurusan.*' => 'exists:tb_jurusan,id_jurusan',
        ], [
            'nuptk.required' => 'Nuptk wajib diisi.',
            'nuptk.unique' => 'Nuptk sudah terdaftar.',
            'nuptk.regex' => 'Nuptk hanya boleh berisi huruf dan angka.',
            'image.image' => 'File gambar harus berformat jpg, png, dan svg.',
            'image.max' => 'Ukuran maksimal file adalah 2048 KB.',
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama maksimal 255 karakter.',
            'nama.regex' => 'Nama hanya boleh berisi huruf.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
            'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan.',
            'agama.required' => 'Agama wajib diisi.',
            'agama.string' => 'Agama harus berupa teks.',
            'agama.max' => 'Agama maksimal 255 karakter.',
            'phone.required' => 'No HP wajib diisi.',
            'phone.unique' => 'No HP sudah terdaftar.',
            'phone.regex' => 'No HP harus berupa angka.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah terdaftar.',
            'email.email' => 'Email tidak valid.',
            'id_mapel.required' => 'Mapel wajib diisi.',
            'id_mapel.exists' => 'Mapel tidak valid.',
            'id_kelas.required' => 'Kelas wajib diisi.',
            'id_kelas.exists' => 'Kelas tidak valid.',
            'id_jurusan.required' => 'Jurusan wajib diisi.',
            'id_jurusan.exists' => 'Jurusan tidak valid.',
        ]);

        // Temukan data guru
        $guru = Guru::findOrFail($id);
        $data = $request->except(['id_mapel', 'id_kelas', 'id_jurusan']);

        // Handle upload image jika ada
        if ($request->hasFile('image')) {
            if ($guru->image) {
                Storage::delete('public/' . $guru->image);
            }
            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = $imagePath;
        }

        // Update data guru
        $guru->update($data);

        // Update relasi Many-to-Many dengan mapel, kelas, dan jurusan
        $guru->mapel()->sync($request->id_mapel);
        $guru->kelas()->sync($request->id_kelas);
        $guru->jurusan()->sync($request->id_jurusan);

        return redirect()->route('guru.index')->with('status', 'Data guru berhasil diupdate!');
    }

    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);
        if ($guru->image) {
            Storage::delete('public/' . $guru->image);
        }

        // Hapus hubungan Many-to-Many sebelum menghapus data guru
        $guru->mapel()->detach();
        $guru->kelas()->detach();
        $guru->jurusan()->detach();

        // Hapus data guru
        $guru->delete();

        return redirect()->route('guru.index')->with('status', 'Data guru berhasil dihapus!');
    }
}
