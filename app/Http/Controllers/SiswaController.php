<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSiswaRequest;
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
        $query = Siswa::query();
        $key = $request->get('key');

        if ($key) {
            $query->where('nama', 'like', "%{$key}%")
                  ->orWhere('nis', 'like', "%{$key}%");
        }

        $siswa = $query->orderBy('created_at', 'desc')->paginate(2)->withQueryString();

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

    public function store(StoreSiswaRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = $imagePath;
        }

        Siswa::create($data);

        return redirect()->route('siswa.index')->with('status', 'Data siswa berhasil disimpan!');
    }

    public function edit(Siswa $siswa)
    {
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        $organisasi = Organisasi::all();
        $ekskul = Ekskul::all();
        return view('siswa.edit', compact('siswa', 'kelas', 'jurusan', 'organisasi', 'ekskul'));
    }

    public function update(StoreSiswaRequest $request, Siswa $siswa)
    {
        $data = $request->validated();

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

    public function destroy(Siswa $siswa)
    {
        if ($siswa->image) {
            Storage::delete('public/' . $siswa->image);
        }

        $siswa->delete();

        return redirect()->route('siswa.index')->with('status', 'Data siswa berhasil dihapus!');
    }
}
