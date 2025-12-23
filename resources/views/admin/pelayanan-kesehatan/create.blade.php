<x-app-layout>
    @section('title', 'Tambah Pelayanan Kesehatan')

    <x-slot name="header">
        <h2 class="fw-semibold fs-4 text-dark m-0">
            Tambah Data Pelayanan Kesehatan
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <form method="POST" action="{{ route('admin.pelayanan-kesehatan.store') }}" class="card card-body border-0 shadow-sm">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal') }}" required>
                    @error('tanggal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Jenis Pelayanan</label>
                    <input type="text" name="jenis_pelayanan" class="form-control @error('jenis_pelayanan') is-invalid @enderror" value="{{ old('jenis_pelayanan') }}" required>
                    @error('jenis_pelayanan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Jumlah</label>
                    <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror" value="{{ old('jumlah') }}" min="0" required>
                    @error('jumlah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Hari Besar</label>
                    <select name="hari_besar" class="form-select @error('hari_besar') is-invalid @enderror">
                        <option value="">Bukan hari besar</option>
                        <option value="nataru" {{ old('hari_besar') === 'nataru' ? 'selected' : '' }}>Nataru</option>
                        <option value="idul_fitri" {{ old('hari_besar') === 'idul_fitri' ? 'selected' : '' }}>Idul Fitri</option>
                        <option value="idul_adha" {{ old('hari_besar') === 'idul_adha' ? 'selected' : '' }}>Idul Adha</option>
                        <option value="imlek" {{ old('hari_besar') === 'imlek' ? 'selected' : '' }}>Imlek</option>
                    </select>
                    @error('hari_besar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.pelayanan-kesehatan.index') }}" class="btn btn-outline-secondary">Batal</a>
                    <button type="submit" class="btn btn-secondary-brand">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
