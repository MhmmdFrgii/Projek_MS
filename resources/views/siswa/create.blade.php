@extends('layouts.app')

@section('title', 'Tambah Data Siswa')

@section('content')
<body class="bg-slate-200">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow bg-slate-600/50">
                <div class="card-header bg-indigo-600/40 text-white fw-bold">Tambah Data Siswa</div>
                <div class="card-body">

                    <form action="{{ route('siswa.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="nis" class="form-label text-white">NIS</label>
                            <input type="text" name="nis" id="nis" class="form-control" value="{{ old('nis') }}" placeholder="Masukkan nis anda">
                            @error('nis')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label class="form-label text-white">Foto</label>
                                <input type="file" name="image" id="image" class="form-control">
                                <img id="image-preview" src="#" alt="Image Preview" style="display: none; margin-top: 10px; max-height: 200px;">
                            </div>
                            @error('image')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label text-white">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" placeholder="Masukkan nama anda">
                            @error('nama')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- <div class="mb-3">
                            <label for="tgl_masuk" class="form-label text-white">Tanggal masuk</label>
                            <input type="date" name="tgl_masuk" id="tgl_masuk" class="form-date" value="{{ old('tgl_masuk') }}">
                            @error('tgl_masuk')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div> --}}
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
                            <label for="phone" class="form-label text-white">No Hp</label>
                            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" placeholder="Masukkan no hp anda">
                            @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label text-white">Email</label>
                            <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="Masukkan email anda">
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="id_kelas" class="form-label text-white">Kelas</label>
                            <select name="id_kelas" id="id_kelas" class="form-select">
                                <option value="">Pilih Kelas</option>
                                @foreach($kelas as $k)
                                <option value="{{ $k->id_kelas }}" {{ old('id_kelas') == $k->id_kelas ? 'selected' : '' }}>{{ $k->kelas }}</option>
                                @endforeach
                            </select>
                            @error('id_kelas')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="id_organisasi" class="form-label text-white">jurusan</label>
                            <select name="id_jurusan" id="id_jurusan" class="form-select">
                                <option value="">Pilih jurusan (Optional)</option>
                                @foreach($jurusan as $o)
                                <option value="{{ $o->id_jurusan }}" {{ old('id_jurusan') == $o->id_jurusan ? 'selected' : '' }}>{{ $o->jurusan }}</option>
                                @endforeach
                            </select>
                            @error('id_jurusan')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="id_organisasi" class="form-label text-white">Organisasi</label>
                            <select name="id_organisasi" id="id_organisasi" class="form-select">
                                <option value="">Pilih Organisasi (Optional)</option>
                                @foreach($organisasi as $o)
                                <option value="{{ $o->id_organisasi }}" {{ old('id_organisasi') == $o->id_organisasi ? 'selected' : '' }}>{{ $o->organisasi }}</option>
                                @endforeach
                            </select>
                            @error('id_organisasi')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="id_ekskul" class="form-label text-white">Ekskul</label>
                            <select name="id_ekskul" id="id_ekskul" class="form-select">
                                <option value="">Pilih Ekskul (Optional)</option>
                                @foreach($ekskul as $e)
                                <option value="{{ $e->id_ekskul }}" {{ old('id_ekskul') == $e->id_ekskul ? 'selected' : '' }}>{{ $e->ekskul }}</option>
                                @endforeach
                                @error('id_ekskul')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label text-white">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control" rows="3" placeholder="Masukkan alamat anda">{{ old('alamat') }}</textarea>
                            @error('alamat')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <a href="{{ route('siswa.index') }}" class="btn btn-danger">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('image').addEventListener('change', function(){
    const [file] = this.files;
    if (file) {
        document.getElementById('image-preview').src = URL.createObjectURL(file);
        document.getElementById('image-preview').style.display = 'block';
    }
});
</script>

@endsection
</body>
