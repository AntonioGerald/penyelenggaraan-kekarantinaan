<x-app-layout>
    @section('title', 'Tambah Penumpang')

    <x-slot name="header">
        <h2 class="fw-semibold fs-4 text-dark m-0">Tambah Data Penumpang</h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.penumpang.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal') }}" required>
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lokasi</label>
                            <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror" value="{{ old('lokasi') }}" required>
                            @error('lokasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis</label>
                            <select name="jenis" class="form-select @error('jenis') is-invalid @enderror" required>
                                <option value="">-- Pilih --</option>
                                <option value="datang" {{ old('jenis') === 'datang' ? 'selected' : '' }}>Datang</option>
                                <option value="berangkat" {{ old('jenis') === 'berangkat' ? 'selected' : '' }}>Berangkat</option>
                            </select>
                            @error('jenis')
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
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.penumpang.index') }}" class="btn btn-outline-secondary">Kembali</a>
                            <button type="submit" class="btn btn-secondary-brand">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
