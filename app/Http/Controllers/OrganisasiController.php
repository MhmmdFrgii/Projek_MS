<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organisasi;

class OrganisasiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('key');
        $organisasi = Organisasi::when($search, function($query, $search) {
            return $query->where('organisasi', 'LIKE', '%' . $search . '%');
        })->get();

        $noDataFound = $organisasi->isEmpty();

        return view('organisasi.index', compact('organisasi', 'noDataFound'));
    }

    public function create()
    {
        return view('organisasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
           'organisasi' => ['required', 'string', 'unique:tb_organisasi,organisasi', 'max:30', 'regex:/^[a-zA-Z0-9 ]+$/'],
        ],[
            'organisasi.required' => 'organisasi wajib diisi.',
            'organisasi.unique' => 'organisasi sudah terdaftar.',
            'organisasi.max' => 'organisasi maksimal 30 karakter.',
            'organisasi.regex' => 'organisasi hanya boleh berisi huruf dan angka.',
        ]);

        Organisasi::create($request->all());

        return redirect()->route('organisasi.index')->with('status', 'Data organisasi berhasil disimpan.');
    }

    public function show($id)
    {
        $organisasi = Organisasi::findOrFail($id);
        return view('organisasi.detail', compact('organisasi'));
    }

    public function edit($id)
    {
        $organisasi = Organisasi::findOrFail($id);
        return view('organisasi.edit', compact('organisasi'));
    }

    public function update(Request $request, $id)
    {

    $organisasi = Organisasi::findOrFail($id);

    $request->validate([
        'organisasi' => ['required', 'string', 'unique:tb_organisasi,organisasi,' . $organisasi->id_organisasi . ',id_organisasi', 'max:30', 'regex:/^[a-zA-Z0-9 ]+$/'],
    ],[
        'organisasi.required' => 'organisasi wajib diisi.',
        'organisasi.unique' => 'organisasi sudah terdaftar.',
        'organisasi.max' => 'organisasi maksimal 30 karakter.',
        'organisasi.regex' => 'organisasi hanya boleh berisi huruf dan angka.',
    ]);

    $organisasi->update([
        'organisasi' => $request->organisasi,
    ]);

    return redirect()->route('organisasi.index')->with('status', 'Data organisasi berhasil diubah.');
    }

    public function destroy($id)
    {
        $organisasi = Organisasi::findOrFail($id);

        if ($organisasi->siswa()->exists()) {
            return redirect()->route('organisasi.index')->with('error', 'organisasi tidak dapat dihapus karena masih terhubung dengan data siswa.');
        }

        $organisasi->delete();

        return redirect()->route('organisasi.index')->with('status', 'Data organisasi berhasil dihapus.');
    }
}
