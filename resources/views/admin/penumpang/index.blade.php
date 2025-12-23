<x-app-layout>
    @section('title', 'Kelola Penumpang')

    <x-slot name="header">
        <h2 class="fw-semibold fs-4 text-dark m-0">
            Data Penumpang
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-3">
                <form method="GET" class="row g-2 align-items-end">
                    <div class="col-auto">
                        <label class="form-label mb-1 small">Tanggal mulai</label>
                        <input type="date" name="tanggal_mulai" class="form-control form-control-sm" value="{{ request('tanggal_mulai') }}">
                    </div>
                    <div class="col-auto">
                        <label class="form-label mb-1 small">Tanggal selesai</label>
                        <input type="date" name="tanggal_selesai" class="form-control form-control-sm" value="{{ request('tanggal_selesai') }}">
                    </div>
                    <div class="col-auto">
                        <label class="form-label mb-1 small">Lokasi</label>
                        <input type="text" name="lokasi" class="form-control form-control-sm" value="{{ request('lokasi') }}" placeholder="Cari lokasi">
                    </div>
                    <div class="col-auto d-flex gap-2">
                        <button type="submit" class="btn btn-sm btn-outline-secondary mt-3">Filter</button>
                        <a href="{{ route('admin.penumpang.index') }}" class="btn btn-sm btn-outline-secondary mt-3">Reset</a>
                    </div>
                </form>

                <div class="d-flex gap-2">
                    <a href="{{ route('admin.penumpang.create') }}" class="btn btn-sm btn-secondary-brand">Tambah Data</a>

                    <form method="GET" action="{{ route('admin.penumpang.exportPdf') }}">
                        <input type="hidden" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}">
                        <input type="hidden" name="tanggal_selesai" value="{{ request('tanggal_selesai') }}">
                        <button type="submit" class="btn btn-sm btn-outline-secondary">Export PDF</button>
                    </form>

                    <form method="POST" action="{{ route('admin.penumpang.importExcel') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex align-items-center gap-1">
                            <input type="file" name="file" class="form-control form-control-sm" accept=".xlsx,.csv,.txt" required>
                            <button type="submit" class="btn btn-sm btn-outline-secondary">Import</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-sm table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Lokasi</th>
                            <th>Jenis</th>
                            <th>Alat</th>
                            <th>Hari Besar</th>
                            <th class="text-end">Jumlah</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($penumpang as $row)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($row->tanggal)->format('d/m/Y') }}</td>
                                <td>{{ $row->lokasi }}</td>
                                <td>{{ ucfirst($row->jenis) }}</td>
                                <td>{{ $row->alat }}</td>
                                <td>{{ $row->hari_besar }}</td>
                                <td class="text-end">{{ $row->jumlah }}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.penumpang.edit', $row) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                    <form action="{{ route('admin.penumpang.destroy', $row) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada data penumpang.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-2">
                {{ $penumpang->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
