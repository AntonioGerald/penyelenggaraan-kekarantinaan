<?php

namespace App\Http\Controllers;

use App\Models\AlatAngkut;
use App\Models\Penumpang;
use App\Models\Penyakit;
use App\Models\PelayananKesehatan;
use App\Models\Kesling;
use App\Models\Vektor;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    /**
     * Tampilkan ringkasan data di halaman depan (public), dapat difilter per tanggal.
     */
    public function index(Request $request): View
    {
        // Ambil rentang tanggal dari query string, misalnya ?tanggal_mulai=2025-12-17&tanggal_selesai=2025-12-25
        $startDate = $request->query('tanggal_mulai');
        $endDate   = $request->query('tanggal_selesai');

        // Jika belum dipilih, gunakan rentang dari tanggal minimum hingga maksimum yang tersedia
        if (!$startDate || !$endDate) {
            $minDate = collect([
                AlatAngkut::min('tanggal'),
                Penumpang::min('tanggal'),
                Penyakit::min('tanggal'),
                PelayananKesehatan::min('tanggal'),
                Kesling::min('tanggal'),
                Vektor::min('tanggal'),
            ])->filter()->min();

            $maxDate = collect([
                AlatAngkut::max('tanggal'),
                Penumpang::max('tanggal'),
                Penyakit::max('tanggal'),
                PelayananKesehatan::max('tanggal'),
                Kesling::max('tanggal'),
                Vektor::max('tanggal'),
            ])->filter()->max();

            $startDate = $startDate ?: $minDate;
            $endDate   = $endDate   ?: $maxDate;
        }

        // Data utama yang difilter berdasarkan rentang tanggal terpilih (jika ada)
        $alatAngkut = AlatAngkut::when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('tanggal', [$startDate, $endDate]);
            })
            ->orderBy('lokasi')
            ->get();

        $penumpang = Penumpang::when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('tanggal', [$startDate, $endDate]);
            })
            ->orderBy('lokasi')
            ->get();

        $penyakit = Penyakit::when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('tanggal', [$startDate, $endDate]);
            })
            ->orderBy('kategori')
            ->orderBy('nama_penyakit')
            ->get();

        $pelayanan = PelayananKesehatan::when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('tanggal', [$startDate, $endDate]);
            })
            ->orderBy('jenis_pelayanan')
            ->get();

        $kesling = Kesling::when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('tanggal', [$startDate, $endDate]);
            })
            ->orderBy('lokasi')
            ->get();

        $vektor = Vektor::when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('tanggal', [$startDate, $endDate]);
            })
            ->orderBy('lokasi')
            ->get();

        // Lokasi unik dari beberapa tabel untuk ringkasan per-lokasi yang dinamis
        $locations = collect()
            ->merge($alatAngkut->pluck('lokasi'))
            ->merge($penumpang->pluck('lokasi'))
            ->merge($kesling->pluck('lokasi'))
            ->merge($vektor->pluck('lokasi'))
            ->filter()
            ->unique()
            ->sort()
            ->values();

        // Ringkasan per-lokasi (datang/berangkat) untuk alat angkut dan penumpang
        $perLocationSummary = $locations->mapWithKeys(function (string $lokasi) use ($alatAngkut, $penumpang) {
            $aaDatang = $alatAngkut->where('lokasi', $lokasi)->where('jenis', 'datang')->sum('jumlah');
            $aaBerangkat = $alatAngkut->where('lokasi', $lokasi)->where('jenis', 'berangkat')->sum('jumlah');

            $pnDatang = $penumpang->where('lokasi', $lokasi)->where('jenis', 'datang')->sum('jumlah');
            $pnBerangkat = $penumpang->where('lokasi', $lokasi)->where('jenis', 'berangkat')->sum('jumlah');

            return [
                $lokasi => [
                    'alat_angkut_datang'    => $aaDatang,
                    'alat_angkut_berangkat' => $aaBerangkat,
                    'penumpang_datang'      => $pnDatang,
                    'penumpang_berangkat'   => $pnBerangkat,
                ],
            ];
        });

        // Ringkasan global seperti di infografis contoh
        $globalSummary = [
            'total_alat_angkut_datang'    => $alatAngkut->where('jenis', 'datang')->sum('jumlah'),
            'total_alat_angkut_berangkat' => $alatAngkut->where('jenis', 'berangkat')->sum('jumlah'),
            'total_penumpang_datang'      => $penumpang->where('jenis', 'datang')->sum('jumlah'),
            'total_penumpang_berangkat'   => $penumpang->where('jenis', 'berangkat')->sum('jumlah'),
            'total_penyakit_menular'      => $penyakit->where('kategori', 'menular')->sum('jumlah'),
            'total_penyakit_tidak_menular'=> $penyakit->where('kategori', 'tidak_menular')->sum('jumlah'),
            'total_pelayanan'             => $pelayanan->sum('jumlah'),
        ];

        return view('welcome', [
            'alatAngkut'    => $alatAngkut,
            'penumpang'     => $penumpang,
            'penyakit'      => $penyakit,
            'pelayanan'     => $pelayanan,
            'kesling'       => $kesling,
            'vektor'        => $vektor,
            'locations'     => $locations,
            'perLocation'   => $perLocationSummary,
            'globalSummary' => $globalSummary,
            'startDate'     => $startDate,
            'endDate'       => $endDate,
        ]);
    }
}
