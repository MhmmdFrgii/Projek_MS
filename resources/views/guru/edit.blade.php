@extends('layouts.app')

@section('title', 'Edit Guru')

@section('content')
<body class="bg-slate-200">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow bg-slate-600/50">
                    <div class="card-header bg-indigo-600/40 text-white fw-bold">Edit Data Guru</div>
                    <div class="card-body">
                        <form action="{{ route('guru.update', $guru->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="nuptk" class="form-label text-white">NUPTK</label>
                                <input type="text" name="nuptk" id="nuptk" class="form-control" value="{{ old('nuptk', $guru->nuptk) }}" placeholder="Masukkan NUPTK">
                                @error('nuptk')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-white">Foto</label>
                                @if($guru->image)
                                <img src="{{ asset('storage/'.$guru->image) }}" alt="Guru Image" width="100">
                                @endif
                                <input type="file" name="image" class="form-control mt-2">
                                @error('image')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nama" class="form-label text-white">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $guru->nama) }}" placeholder="Masukkan nama">
                                @error('nama')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label text-white">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-select">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="agama" class="form-label text-white">Agama</label>
                                <select name="agama" id="agama" class="form-select">
                                    <option value="">Pilih Agama</option>
                                    <option value="Islam" {{ old('agama', $guru->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen" {{ old('agama', $guru->agama) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="Hindu" {{ old('agama', $guru->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Buddha" {{ old('agama', $guru->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                    <option value="Konghucu" {{ old('agama', $guru->agama) == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                    <option value="Katholik" {{ old('agama', $guru->agama) == 'Katholik' ? 'selected' : '' }}>Katholik</option>
                                </select>
                                @error('agama')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label text-white">No HP</label>
                                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $guru->phone) }}" placeholder="Masukkan nomor telepon">
                                @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label text-white">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $guru->email) }}" placeholder="Masukkan email">
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                                <label for="id_mapel" class="form-label">Mengajar Mapel</label>
                                <br>
                                @foreach($mapel as $m)
                                <input type="checkbox" class="btn-check" id="btncheck_mapel{{ $m->id_mapel }}" name="id_mapel[]" value="{{ $m->id_mapel }}" autocomplete="off" {{ in_array($m->id_mapel, $guru->mapel->pluck('id_mapel')->toArray()) ? 'checked' : '' }}>
                                <label class="btn btn-outline-primary" for="btncheck_mapel{{ $m->id_mapel }}">{{ $m->mapel }}</label>
                                @endforeach
                            </div>
                            <br>
                            <br>
                            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                                <label for="id_kelas" class="form-label">Mengajar Kelas</label>
                                <br>
                                @foreach($kelas as $k)
                                <input type="checkbox" class="btn-check" id="btncheck_kelas{{ $k->id_kelas }}" name="id_kelas[]" value="{{ $k->id_kelas }}" autocomplete="off" {{ in_array($k->id_kelas, $guru->kelas->pluck('id_kelas')->toArray()) ? 'checked' : '' }}>
                                <label class="btn btn-outline-primary" for="btncheck_kelas{{ $k->id_kelas }}">{{ $k->kelas }}</label>
                                @endforeach
                            </div>
                            <br>
                            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                                <label for="id_kelas" class="form-label">Mengajar Jurusan</label>
                                <br>
                                @foreach($jurusan as $j)
                                <input type="checkbox" class="btn-check" id="btncheck_jurusan{{ $j->id_jurusan }}" name="id_jurusan[]" value="{{ $j->id_jurusan }}" autocomplete="off" {{ in_array($j->id_jurusan, $guru->jurusan->pluck('id_jurusan')->toArray()) ? 'checked' : '' }}>
                                <label class="btn btn-outline-primary" for="btncheck_jurusan{{ $j->id_jurusan }}">{{ $j->jurusan }}</label>
                                @endforeach
                            </div>
                            <br>
                            
                            <a href="{{ route('guru.index') }}" class="btn btn-danger">Kembali</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection
