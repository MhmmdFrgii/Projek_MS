@extends('layouts.app')

@section('title', 'Data Ekstrakulikuler')

@section('content')
<body class="bg-slate-200">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow bg-slate-600/50">
                <div class="card-header bg-indigo-600/40 text-white fw-bold">Data Ekstrakulikuler</div>
                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success mt-3">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="d-flex">
                        <a href="{{ route('ekskul.create') }}" class="btn btn-success m-3">Tambah Ekskul</a>
                        <a href="{{ route('ekskul.index') }}" class="btn btn-primary m-3">
                            <i class="fa-solid fa-refresh"></i>&nbsp;Refresh
                        </a>
                        <div class="d-flex justify-content-end ml-60">
                            <form action="{{ route('ekskul.index') }}" method="get" class="d-flex">
                                @csrf
                                <input class="form-control col-md-8 h-10" type="text" name="key" placeholder="Cari ekskul" value="{{ old('key', request()->input('key')) }}">
                                <button class="btn btn-primary btn-sm ml-2 col-md-5 h-10" type="submit">Cari</button>
                            </form>
                        </div>
                    </div>

                    @if($noDataFound)
                        <div class="alert alert-warning mt-3">
                            Ekskul yang Anda cari tidak ditemukan.
                        </div>
                    @else

                    <table class="table table-bordered table-dark table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Ekstrakulikuler</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $no = 1;
                            ?>

                            @foreach($ekskul as $k)
                            <tr>
                                <td class="text-center col-md-1">{{ $no++ }}</td>
                                <td class="col-md-7">{{ $k->ekskul }}</td>
                                <td class="text-center col-md-2">
                                    <a href="{{ route('ekskul.edit', $k->id_ekskul) }}" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <form action="{{ route('ekskul.destroy', $k->id_ekskul) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
