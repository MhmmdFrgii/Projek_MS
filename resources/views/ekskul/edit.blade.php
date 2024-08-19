@extends('layouts.app')

@section('title', 'Data Ekstrakulikuler')

@section('content')
<body class="bg-slate-200">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow bg-slate-600/50">
                <div class="card-header bg-indigo-600/40 text-white fw-bold">Edit Ekstrakulikuler</div>
                <div class="card-body">
                    <form action="{{ route('ekskul.update', $ekskul->id_ekskul) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="ekskul" class="form-label text-white">Ekstrakulikuler</label>
                            <input type="text" name="ekskul" id="ekskul" class="form-control" value="{{ old('ekskul', $ekskul->ekskul) }}">
                            @error('ekskul')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <a href="{{ route('ekskul.index') }}" class="btn btn-danger">Kembali</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
                @endsection

                </div>
            </div>
        </div>
    </div>
