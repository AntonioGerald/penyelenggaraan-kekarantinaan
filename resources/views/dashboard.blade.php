<x-app-layout>
    @section('title', 'Dashboard')
    <x-slot name="header">
        <h2 class="fw-semibold fs-4 text-dark m-0">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <style>
        :root{ 
            --color-main: #ffffff; /* primary */
            --color-secondary: #16b3ac; /* secondary */
            --color-accent: #d1dc05; /* accent */
            --text-dark: #0b2230;
        }
        .logo-strip img{ max-height: 60px; object-fit: contain; }
        .logo-strip{ gap: 24px; }

        .role-badge{
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            padding: .15rem .55rem;
            border-radius: 999px;
            font-size: .75rem;
            background: rgba(22,179,172,.08);
            color: var(--color-secondary);
        }

        .btn-icon svg{
            width: 16px;
            height: 16px;
            margin-right: .35rem;
        }

        .summary-cards{
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1rem;
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
        }

        .summary-card{
            border-radius: .75rem;
            border: 1px solid rgba(15, 23, 42, .06);
            padding: .9rem 1rem;
            background: #f8fafc;
        }

        .summary-card-title{
            font-size: .8rem;
            text-transform: uppercase;
            letter-spacing: .06em;
            color: #64748b;
            margin-bottom: .25rem;
        }

        .summary-card-value{
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .summary-card-sub{
            font-size: .75rem;
            color: #94a3b8;
        }

        .role-summary-text{
            font-size: .8rem;
            color: #64748b;
            margin-top: .25rem;
        }

        .empty-state{
            border-radius: .75rem;
            border: 1px dashed rgba(148,163,184,.6);
            background: #f8fafc;
            padding: 1rem 1.25rem;
            margin-top: 1.5rem;
            display: flex;
            gap: .75rem;
            align-items: flex-start;
        }

        .empty-state-icon{
            width: 32px;
            height: 32px;
            flex-shrink: 0;
            color: var(--color-secondary);
        }

        .empty-state-title{
            font-weight: 600;
            margin-bottom: .15rem;
        }

        .empty-state-text{
            font-size: .85rem;
            color: #64748b;
            margin-bottom: .5rem;
        }

        .badge-predikat{
            display: inline-flex;
            align-items: center;
            padding: .15rem .5rem;
            border-radius: 999px;
            font-size: .7rem;
            font-weight: 600;
        }

        .badge-k1{ background: rgba(16,185,129,.12); color: #047857; }
        .badge-k2{ background: rgba(59,130,246,.12); color: #1d4ed8; }
        .badge-k3{ background: rgba(234,179,8,.16); color: #92400e; }
        .badge-k4{ background: rgba(239,68,68,.12); color: #b91c1c; }

        .chart-card {
            border-radius: .75rem;
            border: 1px solid rgba(15, 23, 42, .06);
            padding: .75rem 1rem;
            background: #ffffff;
            margin-top: 1.25rem;
        }
        .chart-card-title {
            font-size: .8rem;
            text-transform: uppercase;
            letter-spacing: .06em;
            color: #64748b;
            margin-bottom: .5rem;
        }

        @media (max-width: 767.98px){
            .summary-cards{
                grid-template-columns: repeat(1, minmax(0, 1fr));
            }
        }
    </style>

    <!-- Logo strip -->
    <div class="py-4">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-center align-items-center logo-strip text-center">
                <img src="{{ asset('assets_images/Logo Kemenkes BKK Bengkulu.png') }}" alt="Logo Kemenkes BKK Bengkulu">
                <img src="{{ asset('assets_images/Logo Karantina Kesehatan.png') }}" alt="Logo Karantina Kesehatan">
                <img src="{{ asset('assets_images/Logo BKK BKL.png') }}" alt="Logo BKK Bengkulu">
            </div>
        </div>
    </div>

    <div class="py-5" style="background: var(--color-main); color: var(--text-dark);">
        <div class="container">
            <div class="bg-white border rounded shadow-sm">
                <div class="accent-bar"></div>
                <div class="p-4 p-md-5">

                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h4 class="mt-2 text-dark mb-0">
                            Selamat datang, <span class="fw-bold">{{ auth()->user()->name }}</span>!
                        </h4>
                        <div class="role-badge ms-3 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="7" r="4" />
                                <path d="M5.5 21a6.5 6.5 0 0 1 13 0Z" />
                            </svg>
                            <span>Admin Karantina</span>
                        </div>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success mb-2" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success mb-2" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <p class="role-summary-text mb-3">
                        Gunakan dashboard ini untuk mengelola data karantina kesehatan. Berikut menu modul admin yang
                        akan digunakan untuk mengelola masing-masing jenis data.
                    </p>

                    <div class="summary-cards">
                        <div class="summary-card">
                            <div class="summary-card-title">Modul Data</div>
                            <div class="summary-card-value">Alat Angkut</div>
                            <div class="summary-card-sub">Manajemen data alat angkut pada pintu masuk.</div>
                            <a href="{{ route('admin.alat-angkut.index') }}" class="btn btn-sm btn-secondary-brand btn-icon mt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 3v18h18" />
                                    <path d="M7 14l4-4 4 4 4-6" />
                                </svg>
                                Kelola Alat Angkut
                            </a>
                        </div>

                        <div class="summary-card">
                            <div class="summary-card-title">Modul Data</div>
                            <div class="summary-card-value">Kesling</div>
                            <div class="summary-card-sub">Pengelolaan data kesehatan lingkungan.</div>
                            <a href="{{ route('admin.kesling.index') }}" class="btn btn-sm btn-secondary-brand btn-icon mt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 3v18h18" />
                                    <path d="M7 14l4-4 4 4 4-6" />
                                </svg>
                                Kelola Kesling
                            </a>
                        </div>

                        <div class="summary-card">
                            <div class="summary-card-title">Modul Data</div>
                            <div class="summary-card-value">Pelayanan Kesehatan</div>
                            <div class="summary-card-sub">Data pelayanan kesehatan di wilayah kerja.</div>
                            <a href="{{ route('admin.pelayanan-kesehatan.index') }}" class="btn btn-sm btn-secondary-brand btn-icon mt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 3v18h18" />
                                    <path d="M7 14l4-4 4 4 4-6" />
                                </svg>
                                Kelola Pelayanan Kesehatan
                            </a>
                        </div>

                        <div class="summary-card">
                            <div class="summary-card-title">Modul Data</div>
                            <div class="summary-card-value">Penumpang</div>
                            <div class="summary-card-sub">Tambah, ubah, hapus, ekspor &amp; impor data penumpang.</div>
                            <a href="{{ route('admin.penumpang.index') }}" class="btn btn-sm btn-secondary-brand btn-icon mt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 3v18h18" />
                                    <path d="M7 14l4-4 4 4 4-6" />
                                </svg>
                                Kelola Penumpang
                            </a>
                        </div>

                        <div class="summary-card">
                            <div class="summary-card-title">Modul Data</div>
                            <div class="summary-card-value">Penyakit</div>
                            <div class="summary-card-sub">Manajemen data penyakit yang dipantau.</div>
                            <a href="{{ route('admin.penyakit.index') }}" class="btn btn-sm btn-secondary-brand btn-icon mt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 3v18h18" />
                                    <path d="M7 14l4-4 4 4 4-6" />
                                </svg>
                                Kelola Penyakit
                            </a>
                        </div>

                        <div class="summary-card">
                            <div class="summary-card-title">Modul Data</div>
                            <div class="summary-card-value">Vektor</div>
                            <div class="summary-card-sub">Pengelolaan data vektor dan surveilans.</div>
                            <a href="{{ route('admin.vektor.index') }}" class="btn btn-sm btn-secondary-brand btn-icon mt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 3v18h18" />
                                    <path d="M7 14l4-4 4 4 4-6" />
                                </svg>
                                Kelola Vektor
                            </a>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('logout') }}" class="mt-4">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary">
                            Logout
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
