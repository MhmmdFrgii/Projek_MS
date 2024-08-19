<?php

namespace App\Http\Controllers;

use App\Models\Ekskul;
use Illuminate\Http\Request;

class EkskulController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('key');
        $ekskul = Ekskul::when($search, function($query, $search) {
            return $query->where('ekskul', 'LIKE', '%' . $search . '%');
        })->get();

        $noDataFound = $ekskul->isEmpty();

        return view('ekskul.index', compact('ekskul', 'noDataFound'));
    }

    public function create()
    {
        return view('ekskul.create');
    }

    public function store(Request $request)
    {
        $request->validate([
           'ekskul' => ['required', 'string', 'unique:tb_ekskul,ekskul', 'max:30', 'regex:/^[a-zA-Z0-9 ]+$/'],
        ],[
            'ekskul.required' => 'Ekstrakulikuler wajib diisi.',
            'ekskul.unique' => 'Ekstrakulikuler sudah terdaftar.',
            'ekskul.max' => 'Ekstrakulikuler maksimal 30 karakter.',
            'ekskul.regex' => 'Ekstrakulikuler hanya boleh berisi huruf dan angka.',
        ]);

        Ekskul::create($request->all());

        return redirect()->route('ekskul.index')->with('status', 'Data Ekstrakulikuler berhasil disimpan.');
    }

    public function edit($id)
    {
        $ekskul = Ekskul::findOrFail($id);
        return view('ekskul.edit', compact('ekskul'));
    }

    public function update(Request $request, $id)
    {

    $ekskul = Ekskul::findOrFail($id);

    $request->validate([
        'ekskul' => ['required', 'string', 'unique:tb_ekskul,ekskul,' . $ekskul->id_ekskul . ',id_ekskul', 'max:30', 'regex:/^[a-zA-Z0-9 ]+$/'],
    ],[
        'ekskul.required' => 'Ekstrakulikuler wajib diisi.',
        'ekskul.unique' => 'Ekstrakulikuler sudah terdaftar.',
        'ekskul.max' => 'Ekstrakulikuler maksimal 30 karakter.',
        'ekskul.regex' => 'Ekstrakulikuler hanya boleh berisi huruf dan angka.',
    ]);

    $ekskul->update([
        'ekskul' => $request->ekskul,
    ]);

    return redirect()->route('ekskul.index')->with('status', 'Data Ekstrakulikuler berhasil diubah.');
    }

    public function destroy($id)
    {
        $ekskul = Ekskul::findOrFail($id);

        if ($ekskul->siswa()->exists()) {
            return redirect()->route('ekskul.index')->with('error', 'Ekstrakulikuler tidak dapat dihapus karena masih terhubung dengan data siswa.');
        }

        $ekskul->delete();

        return redirect()->route('ekskul.index')->with('status', 'Data Ekstrakulikuler berhasil dihapus.');
    }
}

