<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vektor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class VektorController extends Controller
{
    public function index(Request $request): View
    {
        $query = Vektor::query()->orderByDesc('tanggal');

        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $query->whereBetween('tanggal', [$request->tanggal_mulai, $request->tanggal_selesai]);
        }

        if ($request->filled('lokasi')) {
            $query->where('lokasi', 'like', '%'.$request->lokasi.'%');
        }

        $vektor = $query->paginate(15)->withQueryString();

        return view('admin.vektor.index', compact('vektor'));
    }

    public function create(): View
    {
        return view('admin.vektor.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal'    => ['required', 'date'],
            'lokasi'     => ['required', 'string', 'max:100'],
            'lalat'      => ['required', 'in:Ada,Tidak Ada'],
            'kecoa'      => ['required', 'in:Ada,Tidak Ada'],
            'jentik_dbd' => ['required', 'in:Ada,Tidak Ada'],
            'hari_besar' => ['nullable', 'in:nataru,idul_fitri,idul_adha,imlek'],
        ]);

        Vektor::create($validated);

        return Redirect::route('admin.vektor.index')->with('success', 'Data vektor berhasil ditambahkan.');
    }

    public function edit(Vektor $vektor): View
    {
        return view('admin.vektor.edit', compact('vektor'));
    }

    public function update(Request $request, Vektor $vektor)
    {
        $validated = $request->validate([
            'tanggal'    => ['required', 'date'],
            'lokasi'     => ['required', 'string', 'max:100'],
            'lalat'      => ['nullable', 'integer', 'min:0'],
            'kecoa'      => ['nullable', 'integer', 'min:0'],
            'jentik_dbd' => ['nullable', 'integer', 'min:0'],
        ]);

        $vektor->update($validated);

        return Redirect::route('admin.vektor.index')->with('success', 'Data vektor berhasil diperbarui.');
    }

    public function destroy(Vektor $vektor)
    {
        $vektor->delete();

        return Redirect::route('admin.vektor.index')->with('success', 'Data vektor berhasil dihapus.');
    }
}
