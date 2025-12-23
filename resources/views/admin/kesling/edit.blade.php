<x-app-layout>
    @section('title', 'Edit Kesling')

    <x-slot name="header">
        <h2 class="fw-semibold fs-4 text-dark m-0">
            Edit Data Kesling
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <form method="POST" action="{{ route('admin.kesling.update', $kesling) }}" class="card card-body border-0 shadow-sm">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', $kesling->tanggal) }}" required>
                    @error('tanggal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror" value="{{ old('lokasi', $kesling->lokasi) }}" required>
                    @error('lokasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Boraks</label>
                        <input type="text" name="boraks" class="form-control @error('boraks') is-invalid @enderror" value="{{ old('boraks', $kesling->boraks) }}">
                        @error('boraks')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Formalin</label>
                        <input type="text" name="formalin" class="form-control @error('formalin') is-invalid @enderror" value="{{ old('formalin', $kesling->formalin) }}">
                        @error('formalin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Air Minum</label>
                        <input type="text" name="air_minum" class="form-control @error('air_minum') is-invalid @enderror" value="{{ old('air_minum', $kesling->air_minum) }}">
                        @error('air_minum')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Suhu</label>
                        <input type="number" step="0.01" name="suhu" class="form-control @error('suhu') is-invalid @enderror" value="{{ old('suhu', $kesling->suhu) }}">
                        @error('suhu')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Kelembapan</label>
                        <input type="number" step="0.01" name="kelembapan" class="form-control @error('kelembapan') is-invalid @enderror" value="{{ old('kelembapan', $kesling->kelembapan) }}">
                        @error('kelembapan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Pencahayaan</label>
                        <input type="number" step="0.01" name="pencahayaan" class="form-control @error('pencahayaan') is-invalid @enderror" value="{{ old('pencahayaan', $kesling->pencahayaan) }}">
                        @error('pencahayaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Kebisingan</label>
                        <input type="number" step="0.01" name="kebisingan" class="form-control @error('kebisingan') is-invalid @enderror" value="{{ old('kebisingan', $kesling->kebisingan) }}">
                        @error('kebisingan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.kesling.index') }}" class="btn btn-outline-secondary">Batal</a>
                    <button type="submit" class="btn btn-secondary-brand">Update</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
