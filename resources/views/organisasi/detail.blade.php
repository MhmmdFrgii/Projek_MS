<form action="{{ route('organisasi.show', $organisasi->id_organisasi) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="organisasi" class="form-label text-white">Organisasi</label>
        <input type="text" name="organisasi" id="organisasi" class="form-control" value="{{ old('organisasi', $organisasi->organisasi) }}">
        @error('organisasi')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <a href="{{ route('organisasi.index') }}" class="btn btn-danger">Kembali</a>
</form>
