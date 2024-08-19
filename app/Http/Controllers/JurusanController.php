<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurusan;


class JurusanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('key');
        $jurusan = Jurusan::when($search, function($query, $search) {
            return $query->where('jurusan', 'LIKE', '%' . $search . '%');
        })->get();

        $noDataFound = $jurusan->isEmpty();

        return view('jurusan.index', compact('jurusan', 'noDataFound'));
    }

    public function create()
    {
        return view('jurusan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
           'jurusan' => ['required', 'string', 'unique:tb_jurusan,jurusan', 'max:50', 'regex:/^[a-zA-Z0-9 ]+$/'],
        ],[
            'jurusan.required' => 'jurusan wajib diisi.',
            'jurusan.unique' => 'jurusan sudah terdaftar.',
            'jurusan.max' => 'jurusan maksimal 50 karakter.',
            'jurusan.regex' => 'jurusan hanya boleh berisi huruf dan angka.',
        ]);

        Jurusan::create($request->all());

        return redirect()->route('jurusan.index')->with('status', 'Data jurusan berhasil disimpan.');
    }

    public function edit($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        return view('jurusan.edit', compact('jurusan'));
    }

    public function update(Request $request, $id)
    {

    $jurusan = Jurusan::findOrFail($id);

    $request->validate([
        'jurusan' => ['required', 'string', 'unique:tb_jurusan,jurusan,' . $jurusan->id_jurusan . ',id_jurusan', 'max:30', 'regex:/^[a-zA-Z0-9 ]+$/'],
    ],[
        'jurusan.required' => 'Jurusan wajib diisi.',
        'jurusan.unique' => 'Jurusan sudah terdaftar.',
        'jurusan.max' => 'Jurusan maksimal 30 karakter.',
        'jurusan.regex' => 'jurusan hanya boleh berisi huruf dan angka.',
    ]);

    $jurusan->update([
        'jurusan' => $request->jurusan,
    ]);

    return redirect()->route('jurusan.index')->with('status', 'Data jurusan berhasil diubah.');
    }

    public function destroy($id)
    {
        $jurusan = Jurusan::findOrFail($id);

        if ($jurusan->siswa()->exists()) {
            return redirect()->route('jurusan.index')->with('error', 'jurusan tidak dapat dihapus karena masih terhubung dengan data.');
        }

        $jurusan->delete();

        return redirect()->route('jurusan.index')->with('status', 'Data jurusan berhasil dihapus.');
    }
}
