@extends('layouts.app')

@section('title', 'Data Organisasi')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow bg-slate-600/50">
                <div class="card-header bg-indigo-600/40 text-white fw-bold">Tambah Organisasi</div>
                <div class="card-body">
                    <form action="{{ route('organisasi.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="organisasi" class="form-label text-white">Organisasi</label>
                            <input type="text" name="organisasi" id="organisasi" class="form-control" value="{{ old('organisasi') }}">
                            @error('organisasi')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <a href="{{ route('organisasi.index') }}" class="btn btn-danger">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
                @endsection
                </div>
            </div>
        </div>
    </div>

