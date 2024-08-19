@extends('layouts.app')

@section('title', 'Tambah Guru')

@section('content')

<body class="bg-slate-200">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow bg-slate-600/50">
                    <div class="card-header bg-indigo-600/40 text-white fw-bold">Tambah Data Guru</div>
                    <div class="card-body">

                        <form action="{{ route('guru.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="nuptk" class="form-label text-white">NUPTK</label>
                                <input type="text" name="nuptk" id="nuptk" class="form-control" value="{{ old('nuptk') }}" placeholder="Masukkan NUPTK">
                                @error('nuptk')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-group">
                                    <label class="form-label text-white">Foto</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                                @error('image')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nama" class="form-label text-white">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" placeholder="Masukkan nama">
                                @error('nama')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label text-white">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-select">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="agama" class="form-label text-white">Agama</label>
                                <select name="agama" id="agama" class="form-select">
                                    <option value="">Agama</option>
                                    <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                    <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                    <option value="Katholik" {{ old('agama') == 'Katholik' ? 'selected' : '' }}>Katholik</option>
                                </select>
                                @error('agama')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label text-white">No HP</label>
                                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" placeholder="Masukkan nomor telepon">
                                @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label text-white">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="Masukkan email">
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                                <label for="id_mapel" class="form-label">Mengajar Mapel</label>
                                <br>
                                @forelse($mapel as $m)
                                <input type="checkbox" class="btn-check" id="btncheck_mapel{{ $m->id_mapel }}" name="id_mapel[]" value="{{ $m->id_mapel }}" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btncheck_mapel{{ $m->id_mapel }}">{{ $m->mapel }}</label>
                                @empty
                                <label class="btn btn-outline-primary">Kosong</label>
                                @endforelse
                            </div>
                            <br>
                            <br>
                            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                                <label for="id_kelas" class="form-label">Mengajar Kelas</label>
                                <br>
                                @forelse($kelas as $k)
                                <input type="checkbox" class="btn-check" id="btncheck_kelas{{ $k->id_kelas }}" name="id_kelas[]" value="{{ $k->id_kelas }}" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btncheck_kelas{{ $k->id_kelas }}">{{ $k->kelas }}</label>
                                @empty
                                <label class="btn btn-outline-primary">Kosong</label>
                                @endforelse
                            </div>
                            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                                <label for="id_jurusan" class="form-label">Mengajar jurusan</label>
                                <br>
                                @forelse($jurusan as $j)
                                <input type="checkbox" class="btn-check" id="btncheck_jurusan{{ $j->id_jurusan }}" name="id_jurusan[]" value="{{ $j->id_jurusan }}" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btncheck_jurusan{{ $j->id_jurusan }}">{{ $j->jurusan }}</label>
                                @empty
                                <label class="btn btn-outline-primary">Kosong</label>
                                @endforelse
                            </div>
                            <br>
                            {{-- <div class="mb-3">
                                <label for="id_jurusan" class="form-label text-white">Mengajar Jurusan</label>
                                <select name="id_jurusan" id="id_jurusan" class="form-select">
                                    <option value="">Pilih Jurusan</option>
                                    @foreach($jurusan as $j)
                                    <option value="{{ $j->id_jurusan }}" {{ old('id_jurusan') == $j->id_jurusan ? 'selected' : '' }}>{{ $j->jurusan }}</option>
                                    @endforeach
                                </select>
                                @error('id_jurusan')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <br> --}}
                            <a href="{{ route('guru.index') }}" class="btn btn-danger">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
