<x-app-layout>
    @section('title', 'Edit Alat Angkut')

    <x-slot name="header">
        <h2 class="fw-semibold fs-4 text-dark m-0">
            Edit Data Alat Angkut
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <form method="POST" action="{{ route('admin.alat-angkut.update', $alatAngkut) }}" class="card card-body border-0 shadow-sm">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', $alatAngkut->tanggal) }}" required>
                    @error('tanggal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror" value="{{ old('lokasi', $alatAngkut->lokasi) }}" required>
                    @error('lokasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Jenis</label>
                    <input type="text" name="jenis" class="form-control @error('jenis') is-invalid @enderror" value="{{ old('jenis', $alatAngkut->jenis) }}" required>
                    @error('jenis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Jumlah</label>
                    <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror" value="{{ old('jumlah', $alatAngkut->jumlah) }}" min="0" required>
                    @error('jumlah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.alat-angkut.index') }}" class="btn btn-outline-secondary">Batal</a>
                    <button type="submit" class="btn btn-secondary-brand">Update</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
