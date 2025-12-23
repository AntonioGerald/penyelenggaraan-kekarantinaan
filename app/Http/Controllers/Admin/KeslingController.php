<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kesling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class KeslingController extends Controller
{
    public function index(Request $request): View
    {
        $query = Kesling::query()->orderByDesc('tanggal');

        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $query->whereBetween('tanggal', [$request->tanggal_mulai, $request->tanggal_selesai]);
        }

        if ($request->filled('lokasi')) {
            $query->where('lokasi', 'like', '%'.$request->lokasi.'%');
        }

        $kesling = $query->paginate(15)->withQueryString();

        return view('admin.kesling.index', compact('kesling'));
    }

    public function create(): View
    {
        return view('admin.kesling.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal'      => ['required', 'date'],
            'lokasi'       => ['required', 'string', 'max:100'],
            'boraks'       => ['nullable', 'in:MS,TMS'],
            'formalin'     => ['nullable', 'in:MS,TMS'],
            'air_minum'    => ['nullable', 'in:MS,TMS'],
            'suhu'         => ['nullable', 'in:MS,TMS'],
            'kelembapan'   => ['nullable', 'in:MS,TMS'],
            'pencahayaan'  => ['nullable', 'in:MS,TMS'],
            'kebisingan'   => ['nullable', 'in:MS,TMS'],
            'hari_besar'   => ['nullable', 'in:nataru,idul_fitri,idul_adha,imlek'],
        ]);

        Kesling::create($validated);

        return Redirect::route('admin.kesling.index')->with('success', 'Data kesling berhasil ditambahkan.');
    }

    public function edit(Kesling $kesling): View
    {
        return view('admin.kesling.edit', compact('kesling'));
    }

    public function update(Request $request, Kesling $kesling)
    {
        $validated = $request->validate([
            'tanggal'      => ['required', 'date'],
            'lokasi'       => ['required', 'string', 'max:100'],
            'boraks'       => ['nullable', 'string', 'max:50'],
            'formalin'     => ['nullable', 'string', 'max:50'],
            'air_minum'    => ['nullable', 'string', 'max:50'],
            'suhu'         => ['nullable', 'numeric'],
            'kelembapan'   => ['nullable', 'numeric'],
            'pencahayaan'  => ['nullable', 'numeric'],
            'kebisingan'   => ['nullable', 'numeric'],
        ]);

        $kesling->update($validated);

        return Redirect::route('admin.kesling.index')->with('success', 'Data kesling berhasil diperbarui.');
    }

    public function destroy(Kesling $kesling)
    {
        $kesling->delete();

        return Redirect::route('admin.kesling.index')->with('success', 'Data kesling berhasil dihapus.');
    }
}
