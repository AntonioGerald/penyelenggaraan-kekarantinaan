<x-app-layout>
    @section('title', 'Edit Vektor')

    <x-slot name="header">
        <h2 class="fw-semibold fs-4 text-dark m-0">
            Edit Data Vektor
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <form method="POST" action="{{ route('admin.vektor.update', $vektor) }}" class="card card-body border-0 shadow-sm">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', $vektor->tanggal) }}" required>
                    @error('tanggal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror" value="{{ old('lokasi', $vektor->lokasi) }}" required>
                    @error('lokasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Lalat</label>
                        <input type="number" name="lalat" class="form-control @error('lalat') is-invalid @enderror" value="{{ old('lalat', $vektor->lalat) }}" min="0">
                        @error('lalat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Kecoa</label>
                        <input type="number" name="kecoa" class="form-control @error('kecoa') is-invalid @enderror" value="{{ old('kecoa', $vektor->kecoa) }}" min="0">
                        @error('kecoa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Jentik DBD</label>
                        <input type="number" name="jentik_dbd" class="form-control @error('jentik_dbd') is-invalid @enderror" value="{{ old('jentik_dbd', $vektor->jentik_dbd) }}" min="0">
                        @error('jentik_dbd')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.vektor.index') }}" class="btn btn-outline-secondary">Batal</a>
                    <button type="submit" class="btn btn-secondary-brand">Update</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
