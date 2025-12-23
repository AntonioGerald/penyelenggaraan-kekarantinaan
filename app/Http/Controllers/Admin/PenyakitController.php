<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penyakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PenyakitController extends Controller
{
    public function index(Request $request): View
    {
        $query = Penyakit::query()->orderByDesc('tanggal');

        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $query->whereBetween('tanggal', [$request->tanggal_mulai, $request->tanggal_selesai]);
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', 'like', '%'.$request->kategori.'%');
        }

        if ($request->filled('nama_penyakit')) {
            $query->where('nama_penyakit', 'like', '%'.$request->nama_penyakit.'%');
        }

        $penyakit = $query->paginate(15)->withQueryString();

        return view('admin.penyakit.index', compact('penyakit'));
    }

    public function create(): View
    {
        return view('admin.penyakit.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal'       => ['required', 'date'],
            'kategori'      => ['required', 'in:menular,tidak_menular'],
            'nama_penyakit' => ['required', 'string', 'max:150'],
            'jumlah'        => ['required', 'integer', 'min:0'],
            'hari_besar'    => ['nullable', 'in:nataru,idul_fitri,idul_adha,imlek'],
        ]);

        Penyakit::create($validated);

        return Redirect::route('admin.penyakit.index')->with('success', 'Data penyakit berhasil ditambahkan.');
    }

    public function edit(Penyakit $penyakit): View
    {
        return view('admin.penyakit.edit', compact('penyakit'));
    }

    public function update(Request $request, Penyakit $penyakit)
    {
        $validated = $request->validate([
            'tanggal'       => ['required', 'date'],
            'kategori'      => ['required', 'string', 'max:100'],
            'nama_penyakit' => ['required', 'string', 'max:150'],
            'jumlah'        => ['required', 'integer', 'min:0'],
        ]);

        $penyakit->update($validated);

        return Redirect::route('admin.penyakit.index')->with('success', 'Data penyakit berhasil diperbarui.');
    }

    public function destroy(Penyakit $penyakit)
    {
        $penyakit->delete();

        return Redirect::route('admin.penyakit.index')->with('success', 'Data penyakit berhasil dihapus.');
    }
}
