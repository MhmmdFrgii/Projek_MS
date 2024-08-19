@extends('layouts.app')

@section('title', 'Data mapel')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow bg-slate-600/50">
                <div class="card-header bg-indigo-600/40 text-white fw-bold">Edit mapel</div>
                <div class="card-body">
                    <form action="{{ route('mapel.update', $mapel->id_mapel) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="mapel" class="form-label text-white">Mapel</label>
                            <input type="text" name="mapel" id="mapel" class="form-control" value="{{ old('mapel', $mapel->mapel) }}">
                            @error('mapel')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <a href="{{ route('mapel.index') }}" class="btn btn-danger">Kembali</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
                @endsection

                </div>
            </div>
        </div>
    </div>
