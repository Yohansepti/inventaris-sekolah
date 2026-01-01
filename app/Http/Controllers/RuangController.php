<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use Illuminate\Http\Request;

class RuangController extends Controller
{
    public function index()
    {
        $ruang = Ruang::all();
        return view('auth.ruang.index', compact('ruang'));
    }

    public function create()
    {
        return view('auth.ruang.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'kode_ruangan' => [
            'required',
            'regex:/^R[0-9]{3}$/',
            'unique:ruang,kode_ruangan'
        ],
        'nama_ruangan' => 'required|string|max:100',
    ], [
        'kode_ruangan.regex' => 'Kode tidak valid'
    ]);

    Ruang::create([
        'kode_ruangan' => $request->kode_ruangan,
        'nama_ruangan' => $request->nama_ruangan,
    ]);

    return redirect()
        ->route('ruang.index')
        ->with('success', 'Data ruang berhasil ditambahkan');
}


    public function edit($kode_ruangan)
{
    $ruang = Ruang::findOrFail($kode_ruangan);
    return view('auth.ruang.edit', compact('ruang'));
}

public function update(Request $request, $kode_ruangan)
{
    $request->validate([
        'nama_ruangan' => 'required',
    ]);

    $ruang = Ruang::findOrFail($kode_ruangan);
    $ruang->update([
        'nama_ruangan' => $request->nama_ruangan,
    ]);

    return redirect()->route('ruang.index')
                     ->with('success', 'Data ruang berhasil diperbarui');
}
    public function destroy($kode_ruangan)
    {
        $ruang = Ruang::findOrFail($kode_ruangan);
        $ruang->delete();

        return redirect()->route('ruang.index')
                         ->with('success', 'Data ruang berhasil dihapus');
    }
}
