<x-app-layout>
    @section('title', 'Edit Penyakit')

    <x-slot name="header">
        <h2 class="fw-semibold fs-4 text-dark m-0">
            Edit Data Penyakit
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <form method="POST" action="{{ route('admin.penyakit.update', $penyakit) }}" class="card card-body border-0 shadow-sm">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', $penyakit->tanggal) }}" required>
                    @error('tanggal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <input type="text" name="kategori" class="form-control @error('kategori') is-invalid @enderror" value="{{ old('kategori', $penyakit->kategori) }}" required>
                    @error('kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Penyakit</label>
                    <input type="text" name="nama_penyakit" class="form-control @error('nama_penyakit') is-invalid @enderror" value="{{ old('nama_penyakit', $penyakit->nama_penyakit) }}" required>
                    @error('nama_penyakit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Jumlah</label>
                    <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror" value="{{ old('jumlah', $penyakit->jumlah) }}" min="0" required>
                    @error('jumlah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.penyakit.index') }}" class="btn btn-outline-secondary">Batal</a>
                    <button type="submit" class="btn btn-secondary-brand">Update</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
