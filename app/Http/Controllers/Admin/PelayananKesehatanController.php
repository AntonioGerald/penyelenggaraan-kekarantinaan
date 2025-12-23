<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PelayananKesehatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PelayananKesehatanController extends Controller
{
    public function index(Request $request): View
    {
        $query = PelayananKesehatan::query()->orderByDesc('tanggal');

        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $query->whereBetween('tanggal', [$request->tanggal_mulai, $request->tanggal_selesai]);
        }

        if ($request->filled('jenis_pelayanan')) {
            $query->where('jenis_pelayanan', 'like', '%'.$request->jenis_pelayanan.'%');
        }

        $pelayanan = $query->paginate(15)->withQueryString();

        return view('admin.pelayanan-kesehatan.index', compact('pelayanan'));
    }

    public function create(): View
    {
        return view('admin.pelayanan-kesehatan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal'         => ['required', 'date'],
            'jenis_pelayanan' => ['required', 'string', 'max:100'],
            'jumlah'          => ['required', 'integer', 'min:0'],
            'hari_besar'      => ['nullable', 'in:nataru,idul_fitri,idul_adha,imlek'],
        ]);

        PelayananKesehatan::create($validated);

        return Redirect::route('admin.pelayanan-kesehatan.index')->with('success', 'Data pelayanan kesehatan berhasil ditambahkan.');
    }

    public function edit(PelayananKesehatan $pelayananKesehatan): View
    {
        return view('admin.pelayanan-kesehatan.edit', compact('pelayananKesehatan'));
    }

    public function update(Request $request, PelayananKesehatan $pelayananKesehatan)
    {
        $validated = $request->validate([
            'tanggal'         => ['required', 'date'],
            'jenis_pelayanan' => ['required', 'string', 'max:100'],
            'jumlah'          => ['required', 'integer', 'min:0'],
            'hari_besar'      => ['nullable', 'in:nataru,idul_fitri,idul_adha,imlek'],
        ]);

        $pelayananKesehatan->update($validated);

        return Redirect::route('admin.pelayanan-kesehatan.index')->with('success', 'Data pelayanan kesehatan berhasil diperbarui.');
    }

    public function destroy(PelayananKesehatan $pelayananKesehatan)
    {
        $pelayananKesehatan->delete();

        return Redirect::route('admin.pelayanan-kesehatan.index')->with('success', 'Data pelayanan kesehatan berhasil dihapus.');
    }
}
