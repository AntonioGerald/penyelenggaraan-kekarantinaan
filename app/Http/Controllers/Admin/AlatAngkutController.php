<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AlatAngkut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AlatAngkutController extends Controller
{
    public function index(Request $request): View
    {
        $query = AlatAngkut::query()->orderByDesc('tanggal');

        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $query->whereBetween('tanggal', [$request->tanggal_mulai, $request->tanggal_selesai]);
        }

        if ($request->filled('lokasi')) {
            $query->where('lokasi', 'like', '%'.$request->lokasi.'%');
        }

        $alatAngkut = $query->paginate(15)->withQueryString();

        return view('admin.alat-angkut.index', compact('alatAngkut'));
    }

    public function create(): View
    {
        return view('admin.alat-angkut.create');
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

        AlatAngkut::create($validated);

        return Redirect::route('admin.alat-angkut.index')->with('success', 'Data alat angkut berhasil ditambahkan.');
    }

    public function edit(AlatAngkut $alatAngkut): View
    {
        return view('admin.alat-angkut.edit', compact('alatAngkut'));
    }

    public function update(Request $request, AlatAngkut $alatAngkut)
    {
        $validated = $request->validate([
            'tanggal' => ['required', 'date'],
            'lokasi'  => ['required', 'string', 'max:100'],
            'jenis'   => ['required', 'in:datang,berangkat'],
            'alat'    => ['required', 'in:Pesawat,Kapal'],
            'jumlah'  => ['required', 'integer', 'min:0'],
            'hari_besar' => ['nullable', 'in:nataru,idul_fitri,idul_adha,imlek'],
        ]);

        $alatAngkut->update($validated);

        return Redirect::route('admin.alat-angkut.index')->with('success', 'Data alat angkut berhasil diperbarui.');
    }

    public function destroy(AlatAngkut $alatAngkut)
    {
        $alatAngkut->delete();

        return Redirect::route('admin.alat-angkut.index')->with('success', 'Data alat angkut berhasil dihapus.');
    }
}
