<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('key');
        $mapel = Mapel::when($search, function($query, $search) {
            return $query->where('mapel', 'LIKE', '%' . $search . '%');
        })->get();

        $noDataFound = $mapel->isEmpty();

        return view('mapel.index', compact('mapel', 'noDataFound'));
    }

    public function create()
    {
        return view('mapel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
           'mapel' => ['required', 'string', 'unique:tb_mapel,mapel', 'max:30', 'regex:/^[a-zA-Z\s]+$/'],
        ],[
            'mapel.required' => 'mapel wajib diisi.',
            'mapel.unique' => 'mapel sudah terdaftar.',
            'mapel.max' => 'mapel maksimal 30 karakter.',
            'mapel.regex' => 'mapel hanya boleh berisi huruf.',
        ]);

        Mapel::create($request->all());

        return redirect()->route('mapel.index')->with('status', 'Data mapel berhasil disimpan.');
    }

    public function edit($id)
    {
        $mapel = Mapel::findOrFail($id);
        return view('mapel.edit', compact('mapel'));
    }

    public function update(Request $request, $id)
    {

    $mapel = Mapel::findOrFail($id);

    $request->validate([
        'mapel' => ['required', 'string', 'unique:tb_mapel,mapel,' . $mapel->id_mapel . ',id_mapel', 'max:30', 'regex:/^[a-zA-Z\s]+$/'],
    ],[
        'mapel.required' => 'mapel wajib diisi.',
        'mapel.unique' => 'mapel sudah terdaftar.',
        'mapel.max' => 'mapel maksimal 30 karakter.',
        'mapel.regex' => 'mapel hanya boleh berisi huruf.',
    ]);

    $mapel->update([
        'mapel' => $request->mapel,
    ]);

    return redirect()->route('mapel.index')->with('status', 'Data mapel berhasil diubah.');
    }

    public function destroy($id)
    {
        $mapel = Mapel::findOrFail($id);

        // if ($mapel->siswa()->exists()) {
        //     return redirect()->route('mapel.index')->with('error', 'mapel tidak dapat dihapus karena masih terhubung dengan data guru.');
        // }

        $mapel->delete();

        return redirect()->route('mapel.index')->with('status', 'Data mapel berhasil dihapus.');
    }

    public function trashed()
    {
        $mapel = Mapel::onlyTrashed()->get();
        return view('mapel.trashed', compact('mapel'));
    }

    public function restore($id)
    {
        $mapel = Mapel::withTrashed()->findOrFail($id);
        $mapel->restore();

        return redirect()->route('mapel.trashed')->with('status', 'Data mapel berhasil dipulihkan.');
    }

    // public function forceDelete($id)
    // {
    //     $mapel = Mapel::withTrashed()->findOrFail($id);
    //     $mapel->forceDelete();

    //     return redirect()->route('mapel.trashed')->with('status', 'Data mapel berhasil dihapus permanen.');
    // }
}
