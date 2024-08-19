@extends('layouts.app')

@section('title', 'Data Jurusan')

@section('content')
<body class="bg-slate-200">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow bg-slate-600/50">
                <div class="card-header bg-indigo-600/40 text-white fw-bold">Edit Jurusan</div>
                <div class="card-body">
                    <form action="{{ route('jurusan.update', $jurusan->id_jurusan) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="jurusan" class="form-label text-white">Jurusan</label>
                            <input type="text" name="jurusan" id="jurusan" class="form-control" value="{{ old('jurusan', $jurusan->jurusan) }}">
                            @error('jurusan')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <a href="{{ route('jurusan.index') }}" class="btn btn-danger">Kembali</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
                @endsection

                </div>
            </div>
        </div>
    </div>
