@extends('layouts.app')

@section('title', 'Data Kelas')

@section('content')
<body class="bg-slate-200">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow bg-slate-600/50">
                <div class="card-header bg-indigo-600/40 text-white fw-bold">Edit Kelas</div>
                <div class="card-body">
                    <form action="{{ route('kelas.update', $kelas->id_kelas) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="kelas" class="form-label text-white">Kelas</label>
                            <input type="text" name="kelas" id="kelas" class="form-control" value="{{ old('kelas', $kelas->kelas)  }}">
                            @error('kelas')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <a href="{{ route('kelas.index') }}" class="btn btn-danger">Kembali</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
                @endsection

                </div>
            </div>
        </div>
    </div>
