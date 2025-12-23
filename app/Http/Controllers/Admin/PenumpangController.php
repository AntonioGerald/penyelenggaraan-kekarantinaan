<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penumpang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PenumpangController extends Controller
{
    public function index(Request $request): View
    {
        $query = Penumpang::query()->orderByDesc('tanggal');

        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $query->whereBetween('tanggal', [$request->tanggal_mulai, $request->tanggal_selesai]);
        }

        if ($request->filled('lokasi')) {
            $query->where('lokasi', 'like', '%'.$request->lokasi.'%');
        }

        $penumpang = $query->paginate(15)->withQueryString();

        return view('admin.penumpang.index', compact('penumpang'));
    }

    public function create(): View
    {
        return view('admin.penumpang.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => ['required', 'date'],
            'lokasi'  => ['required', 'string', 'max:100'],
            'jenis'   => ['required', 'in:datang,berangkat'],
            'alat'    => ['required', 'in:Pesawat,Kapal'],
            'jumlah'  => ['required', 'integer', 'min:0'],
            'hari_besar' => ['nullable', 'in:nataru,idul_fitri,idul_adha,imlek'],
        ]);

        Penumpang::create($validated);

        return Redirect::route('admin.penumpang.index')->with('success', 'Data penumpang berhasil ditambahkan.');
    }

    public function edit(Penumpang $penumpang): View
    {
        return view('admin.penumpang.edit', compact('penumpang'));
    }

    public function update(Request $request, Penumpang $penumpang)
    {
        $validated = $request->validate([
            'tanggal' => ['required', 'date'],
            'lokasi'  => ['required', 'string', 'max:100'],
            'jenis'   => ['required', 'in:datang,berangkat'],
            'jumlah'  => ['required', 'integer', 'min:0'],
        ]);

        $penumpang->update($validated);

        return Redirect::route('admin.penumpang.index')->with('success', 'Data penumpang berhasil diperbarui.');
    }

    public function destroy(Penumpang $penumpang)
    {
        $penumpang->delete();

        return Redirect::route('admin.penumpang.index')->with('success', 'Data penumpang berhasil dihapus.');
    }

    /**
     * Export data penumpang menjadi PDF sederhana.
     *
     * Catatan: Anda perlu menginstal barryvdh/laravel-dompdf dan menyesuaikan konfigurasi bila belum.
     */
    public function exportPdf(Request $request)
    {
        $query = Penumpang::query()->orderByDesc('tanggal');

        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $query->whereBetween('tanggal', [$request->tanggal_mulai, $request->tanggal_selesai]);
        }

        $data = $query->get();

        // Menggunakan view khusus PDF
        $pdfView = view('admin.penumpang.export_pdf', [
            'data' => $data,
        ])->render();

        // Jika paket dompdf telah diinstal, Anda dapat mengganti bagian ini dengan:
        // $pdf = \PDF::loadView('admin.penumpang.export_pdf', ['data' => $data]);
        // return $pdf->download('penumpang.pdf');

        // Sementara: kembalikan HTML biasa agar tidak error jika dompdf belum terpasang
        return response($pdfView);
    }

    /**
     * Import data penumpang dari file Excel.
     *
     * Catatan: Untuk produksi, disarankan menggunakan maatwebsite/excel.
     */
    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:xlsx,csv,txt'],
        ]);

        $path = $request->file('file')->store('imports');
        $fullPath = Storage::path($path);

        // Placeholder: di sini Anda dapat membaca file menggunakan maatwebsite/excel
        // Contoh (setelah paket diinstal dan Import class dibuat):
        // Excel::import(new PenumpangImport, $request->file('file'));

        return Redirect::route('admin.penumpang.index')->with('success', 'File import diterima. Silakan lengkapi proses parsing sesuai kebutuhan.');
    }
}
