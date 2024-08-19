@extends('layouts.app')

@section('title', 'Mapel Terhapus')

@section('content')
<body class="bg-slate-200">
    <div class="container">
        <div class="card shadow bg-slate-600/50">
            <div class="card-header bg-indigo-600/40 text-white fw-bold">Mapel Terhapus</div>
            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <a href="{{ route('mapel.index') }}" class="btn btn-primary m-3">
                    <i class="fa-solid fa-arrow-left"></i>&nbsp;Kembali
                </a>

                @if($mapel->isEmpty())
                <div class="alert alert-warning">
                    Tidak ada data mapel yang terhapus.
                </div>
                @else
                @foreach($mapel as $m)
                <div class="card mb-3 mt-3 border-0 bg-slate-500/40">
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-white text-xl">{{ $m->mapel }}</h5>
                        <hr class="col-md-2 mb-2">
                        <div class="d-flex mt-4">
                            <form action="{{ route('mapel.restore', $m->id_mapel) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm text-black">
                                    <i class="fa-solid fa-undo"></i>&nbsp;Restore
                                </button>
                            </form>
                            {{-- <form action="{{ route('mapel.forceDelete', $m->id_mapel) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm ml-5" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini secara permanen?');">
                                    <i class="fa-solid fa-trash"></i>&nbsp;Delete Permanen
                                </button>
                            </form> --}}
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection

</body>
