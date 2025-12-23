<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Karantina Kesehatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root{ 
            --color-main: #ffffff;
            --color-secondary: #16b3ac;
            --color-accent: #d2dc02;
            --text-dark: #0b2230;
        }

        body{
            background: #f5f7fb;
            color: var(--text-dark);
            font-family: 'Poppins', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        .navbar{
            background-color: var(--color-secondary) !important;
            padding-top: 0.4rem;
            padding-bottom: 0.4rem;
        }

        .navbar .nav-link,
        .navbar .navbar-brand{ color:#fff !important; }

        .navbar-brand{ display:flex; align-items:center; gap:16px; }
        .navbar-brand img{ height:40px; object-fit:contain; }

        .btn-accent{
            background: var(--color-accent);
            color:#000;
            border:none;
        }
        .btn-accent:hover{ filter:brightness(.95); }

        .hero-section{
            background-image: url('{{ asset('assets_images/bg.jpg') }}');
            background-size: cover;
            background-position: center;
            position: relative;
            color:#fff;
        }

        .hero-overlay{
            position:absolute;
            inset:0;
            background: linear-gradient(120deg, rgba(0,0,0,0.7), rgba(0,0,0,0.35));
        }

        .hero-content{
            position:relative;
            z-index:1;
            padding:6rem 0 4rem;
        }

        .hero-title{ font-weight:700; }
        .hero-subtitle{ max-width:640px; }

        .summary-card{
            border-radius: 0.75rem;
            border: none;
            box-shadow: 0 10px 25px rgba(11,34,48,0.08);
        }

        .summary-label{ font-size:.9rem; text-transform:uppercase; letter-spacing:.04em; color:#7b8a97; }
        .summary-value{ font-size:1.6rem; font-weight:700; }

        .accent-underline{ width:80px; height:4px; background:var(--color-accent); border-radius:2px; margin:8px 0 0; }

        .section-title{ font-weight:600; }
        .section-subtitle{ color:#6c7a86; }

        .data-section{
            background:#ffffff;
            border-radius:1rem;
            box-shadow:0 8px 24px rgba(11,34,48,0.06);
            padding:1.5rem 1.5rem 1.25rem;
            margin-bottom:1.5rem;
        }

        .chart-wrapper{
            position: relative;
            height: 220px;
        }

        .table thead th{
            font-size:.8rem;
            text-transform:uppercase;
            letter-spacing:.06em;
            color:#7b8a97;
            border-bottom-width:1px;
            border-color:#e4e9f0;
        }

        .table tbody td{
            vertical-align:middle;
            font-size:.9rem;
        }

        .badge-status{
            font-size:.75rem;
            text-transform:uppercase;
            letter-spacing:.06em;
        }

        footer{
            background: var(--color-secondary);
            color:#e8f3f2;
            padding:2rem 0 1.5rem;
            margin-top:2rem;
        }

        @media (max-width: 767.98px){
            .hero-content{ padding:5rem 0 3rem; }
            .hero-title{ font-size:1.8rem; }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('assets_images/Logo Kemenkes BKK Bengkulu.png') }}" alt="Logo Kemenkes BKK Bengkulu">
                <img src="{{ asset('assets_images/Logo Karantina Kesehatan.png') }}" alt="Logo Karantina Kesehatan">
                <img src="{{ asset('assets_images/Logo BKK BKL.png') }}" alt="Logo BKK Bengkulu">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-2">
                    <li class="nav-item"><a class="nav-link active" href="#">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#ringkasan">Ringkasan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#data">Data</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="container hero-content">
            <div class="row align-items-center">
                <div class="col-lg-7 mb-4 mb-lg-0">
                    <h1 class="hero-title display-5 mb-3">Dashboard Karantina Kesehatan</h1>
                    <p class="hero-subtitle mb-3">
                        Menyajikan informasi harian mengenai alat angkut, penumpang, penyakit, pelayanan kesehatan,
                        kesehatan lingkungan, dan vektor penyakit di wilayah kerja Kantor Kesehatan Pelabuhan.
                    </p>
                    <p class="mb-3 fw-semibold">
                        Rentang pemantauan:
                        @if($startDate && $endDate)
                            <span class="badge bg-light text-dark ms-1">
                                {{ \Carbon\Carbon::parse($startDate)->translatedFormat('d F Y') }}
                                &ndash;
                                {{ \Carbon\Carbon::parse($endDate)->translatedFormat('d F Y') }}
                            </span>
                        @else
                            <span class="badge bg-warning text-dark ms-1">Belum ada data</span>
                        @endif
                    </p>
                    <a href="#data" class="btn btn-accent btn-lg me-2 mb-2">Lihat Data</a>
                </div>
                <div class="col-lg-5">
                    <form method="GET" action="{{ route('welcome') }}" class="bg-light bg-opacity-75 p-3 rounded-3 shadow-sm">
                        <div class="mb-2 small text-muted text-uppercase">Pilih Rentang Tanggal</div>
                        <div class="row g-2 align-items-center">
                            <div class="col-12 col-sm-5">
                                <input type="date" name="tanggal_mulai" class="form-control form-control-sm" value="{{ $startDate }}">
                            </div>
                            <div class="col-12 col-sm-5">
                                <input type="date" name="tanggal_selesai" class="form-control form-control-sm" value="{{ $endDate }}">
                            </div>
                            <div class="col-12 col-sm-2 d-grid">
                                <button type="submit" class="btn btn-secondary btn-sm">Tampilkan</button>
                            </div>
                        </div>
                        @if($startDate && $endDate)
                            <div class="mt-2 small text-muted">
                                Menampilkan data untuk rentang tanggal yang dipilih.
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section id="ringkasan" class="py-4" style="background:#f0f4f9;">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12 col-lg-8">
                    <h2 class="section-title mb-1">Ringkasan Cepat</h2>
                    <p class="section-subtitle mb-0">Gambaran umum data untuk tanggal pemantauan terpilih.</p>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card summary-card h-100">
                        <div class="card-body">
                            <div class="summary-label mb-1">Alat Angkut Datang</div>
                            <div class="summary-value mb-1">{{ $globalSummary['total_alat_angkut_datang'] ?? 0 }}</div>
                            <div class="text-muted small">Total unit</div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card summary-card h-100">
                        <div class="card-body">
                            <div class="summary-label mb-1">Alat Angkut Berangkat</div>
                            <div class="summary-value mb-1">{{ $globalSummary['total_alat_angkut_berangkat'] ?? 0 }}</div>
                            <div class="text-muted small">Total unit</div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card summary-card h-100">
                        <div class="card-body">
                            <div class="summary-label mb-1">Penumpang Datang</div>
                            <div class="summary-value mb-1">{{ $globalSummary['total_penumpang_datang'] ?? 0 }}</div>
                            <div class="text-muted small">Total orang</div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card summary-card h-100">
                        <div class="card-body">
                            <div class="summary-label mb-1">Penumpang Berangkat</div>
                            <div class="summary-value mb-1">{{ $globalSummary['total_penumpang_berangkat'] ?? 0 }}</div>
                            <div class="text-muted small">Total orang</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-12 col-lg-8">
                    <div class="data-section h-100">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <h5 class="mb-0">Aktivitas Per Lokasi</h5>
                                <small class="text-muted">Perbandingan alat angkut dan penumpang datang/berangkat per lokasi</small>
                            </div>
                        </div>
                        <div class="chart-wrapper">
                            <canvas id="perLocationChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="data-section h-100">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <h5 class="mb-0">Komposisi Penyakit</h5>
                                <small class="text-muted">Perbandingan kasus menular dan tidak menular</small>
                            </div>
                        </div>
                        <div class="chart-wrapper">
                            <canvas id="penyakitChart"></canvas>
                        </div>
                        <div class="mt-3 small text-muted">
                            Total menular: <strong>{{ $globalSummary['total_penyakit_menular'] ?? 0 }}</strong> kasus<br>
                            Total tidak menular: <strong>{{ $globalSummary['total_penyakit_tidak_menular'] ?? 0 }}</strong> kasus
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="data" class="py-4">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12 col-lg-8">
                    <h2 class="section-title mb-1">Detail Data Terbaru</h2>
                    <p class="section-subtitle mb-0">Menampilkan hingga 10 entri terbaru dari setiap jenis data.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 mb-3">
                    <div class="data-section">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <h5 class="mb-0">Alat Angkut</h5>
                                <small class="text-muted">Kedatangan dan keberangkatan alat angkut</small>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-sm mb-0">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Lokasi</th>
                                        <th>Jenis</th>
                                        <th class="text-end">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($alatAngkut as $row)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($row->tanggal)->format('d/m/Y') }}</td>
                                            <td>{{ $row->lokasi }}</td>
                                            <td>
                                                <span class="badge badge-status bg-{{ $row->jenis === 'datang' ? 'success' : 'primary' }}">
                                                    {{ ucfirst($row->jenis) }}
                                                </span>
                                            </td>
                                            <td class="text-end">{{ $row->jumlah }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">Belum ada data alat angkut.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-3">
                    <div class="data-section">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <h5 class="mb-0">Penumpang</h5>
                                <small class="text-muted">Kedatangan dan keberangkatan penumpang</small>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-sm mb-0">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Lokasi</th>
                                        <th>Jenis</th>
                                        <th class="text-end">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($penumpang as $row)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($row->tanggal)->format('d/m/Y') }}</td>
                                            <td>{{ $row->lokasi }}</td>
                                            <td>
                                                <span class="badge badge-status bg-{{ $row->jenis === 'datang' ? 'success' : 'primary' }}">
                                                    {{ ucfirst($row->jenis) }}
                                                </span>
                                            </td>
                                            <td class="text-end">{{ $row->jumlah }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">Belum ada data penumpang.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 mb-3">
                    <div class="data-section">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <h5 class="mb-0">Penyakit</h5>
                                <small class="text-muted">Kasus penyakit menular dan tidak menular</small>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-sm mb-0">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Kategori</th>
                                        <th>Penyakit</th>
                                        <th class="text-end">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($penyakit as $row)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($row->tanggal)->format('d/m/Y') }}</td>
                                            <td>
                                                <span class="badge badge-status bg-{{ $row->kategori === 'menular' ? 'danger' : 'secondary' }}">
                                                    {{ str_replace('_', ' ', ucfirst($row->kategori)) }}
                                                </span>
                                            </td>
                                            <td>{{ $row->nama_penyakit }}</td>
                                            <td class="text-end">{{ $row->jumlah }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">Belum ada data penyakit.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-3">
                    <div class="data-section">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <h5 class="mb-0">Pelayanan Kesehatan</h5>
                                <small class="text-muted">Pelayanan kesehatan yang diberikan</small>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-sm mb-0">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Jenis Pelayanan</th>
                                        <th class="text-end">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pelayanan as $row)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($row->tanggal)->format('d/m/Y') }}</td>
                                            <td>{{ $row->jenis_pelayanan }}</td>
                                            <td class="text-end">{{ $row->jumlah }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-muted">Belum ada data pelayanan kesehatan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 mb-3">
                    <div class="data-section">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <h5 class="mb-0">Kesehatan Lingkungan</h5>
                                <small class="text-muted">Hasil pemeriksaan parameter lingkungan</small>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-sm mb-0">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Lokasi</th>
                                        <th>Parameter</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($kesling as $row)
                                        @php
                                            $params = [
                                                'Boraks' => $row->boraks,
                                                'Formalin' => $row->formalin,
                                                'Air Minum' => $row->air_minum,
                                                'Suhu' => $row->suhu,
                                                'Kelembapan' => $row->kelembapan,
                                                'Pencahayaan' => $row->pencahayaan,
                                                'Kebisingan' => $row->kebisingan,
                                            ];
                                        @endphp
                                        @foreach($params as $label => $status)
                                            @if(!is_null($status))
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($row->tanggal)->format('d/m/Y') }}</td>
                                                    <td>{{ $row->lokasi }}</td>
                                                    <td>{{ $label }}</td>
                                                    <td>
                                                        <span class="badge badge-status bg-{{ $status === 'MS' ? 'success' : 'danger' }}">
                                                            {{ $status }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">Belum ada data kesehatan lingkungan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-3">
                    <div class="data-section">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <h5 class="mb-0">Vektor Penyakit</h5>
                                <small class="text-muted">Kehadiran lalat, kecoa, dan jentik DBD</small>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-sm mb-0">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Lokasi</th>
                                        <th>Vektor</th>
                                        <th>Kehadiran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($vektor as $row)
                                        @php
                                            $vektorParams = [
                                                'Lalat' => $row->lalat,
                                                'Kecoa' => $row->kecoa,
                                                'Jentik DBD' => $row->jentik_dbd,
                                            ];
                                        @endphp
                                        @foreach($vektorParams as $label => $exist)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($row->tanggal)->format('d/m/Y') }}</td>
                                                <td>{{ $row->lokasi }}</td>
                                                <td>{{ $label }}</td>
                                                <td>
                                                    <span class="badge badge-status bg-{{ $exist ? 'danger' : 'success' }}">
                                                        {{ $exist ? 'Ada' : 'Tidak Ada' }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">Belum ada data vektor.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container text-center">
            <div class="mb-1 small">Balai Kekarantinaan Kesehatan Kelas II Bengkulu</div>
            <div class="small">&copy; {{ date('Y') }}. Semua hak dilindungi.</div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Data dari server untuk chart
            const locations = @json($locations ?? []);
            const perLocation = @json($perLocation ?? []);
            const globalSummary = @json($globalSummary ?? []);

            // Siapkan dataset per lokasi
            const aaDatang = locations.map(l => (perLocation[l]?.alat_angkut_datang) ?? 0);
            const aaBerangkat = locations.map(l => (perLocation[l]?.alat_angkut_berangkat) ?? 0);
            const pnDatang = locations.map(l => (perLocation[l]?.penumpang_datang) ?? 0);
            const pnBerangkat = locations.map(l => (perLocation[l]?.penumpang_berangkat) ?? 0);

            const perLocationCanvas = document.getElementById('perLocationChart');
            if (perLocationCanvas && locations.length > 0 && window.Chart) {
                new Chart(perLocationCanvas, {
                    type: 'bar',
                    data: {
                        labels: locations,
                        datasets: [
                            {
                                label: 'AA Datang',
                                data: aaDatang,
                                backgroundColor: 'rgba(22, 179, 172, 0.8)',
                            },
                            {
                                label: 'AA Berangkat',
                                data: aaBerangkat,
                                backgroundColor: 'rgba(22, 179, 172, 0.35)',
                            },
                            {
                                label: 'Penumpang Datang',
                                data: pnDatang,
                                backgroundColor: 'rgba(210, 220, 2, 0.9)',
                            },
                            {
                                label: 'Penumpang Berangkat',
                                data: pnBerangkat,
                                backgroundColor: 'rgba(210, 220, 2, 0.45)',
                            },
                        ],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { position: 'bottom' },
                        },
                        scales: {
                            x: { stacked: false },
                            y: { beginAtZero: true },
                        },
                    },
                });
            }

            // Chart penyakit (doughnut)
            const penyakitCanvas = document.getElementById('penyakitChart');
            if (penyakitCanvas && window.Chart) {
                const menular = globalSummary.total_penyakit_menular ?? 0;
                const tidakMenular = globalSummary.total_penyakit_tidak_menular ?? 0;

                new Chart(penyakitCanvas, {
                    type: 'doughnut',
                    data: {
                        labels: ['Menular', 'Tidak Menular'],
                        datasets: [{
                            data: [menular, tidakMenular],
                            backgroundColor: [
                                'rgba(220, 53, 69, 0.9)',
                                'rgba(108, 117, 125, 0.9)',
                            ],
                            borderWidth: 1,
                        }],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { position: 'bottom' },
                        },
                    },
                });
            }
        });
    </script>
</body>
</html>
