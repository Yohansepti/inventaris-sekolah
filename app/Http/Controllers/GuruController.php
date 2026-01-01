<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        $guru = Guru::all();
        return view('auth.guru.index', compact('guru'));
    }

    public function create()
    {
        return view('auth.guru.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nip' => [
            'required',
            'regex:/^(\d+|-)$/' 
        ],
        'nama' => [
            'required',
            'regex:/^[a-zA-Z\s]+$/'
        ],
        'jabatan' => [
            'required',
            'regex:/^[a-zA-Z\s]+$/'
        ],
    ], [
        'nip.required' => 'NIP tidak valid',
        'nip.regex' => 'NIP tidak valid',

        'nama.required' => 'Nama tidak valid',
        'nama.regex' => 'Nama tidak valid',

        'jabatan.required' => 'Jabatan tidak valid',
        'jabatan.regex' => 'Jabatan tidak valid',
    ]);

    Guru::create([
        'nama' => $request->nama,
        'nip' => $request->nip,
        'jabatan' => $request->jabatan,
    ]);

    return redirect()->route('guru.index')
                     ->with('success', 'Data guru berhasil disimpan');
}


    public function edit($id)
{
    $guru = Guru::findOrFail($id);
    return view('auth.guru.edit', compact('guru'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nama' => 'required',
        'nip' => 'nullable',
        'jabatan' => 'required',
    ]);

    $guru = Guru::findOrFail($id);
    $guru->update([
        'nama' => $request->nama,
        'nip' => $request->nip,
        'jabatan' => $request->jabatan,
    ]);

    return redirect()->route('guru.index')
                     ->with('success', 'Data guru berhasil diperbarui');
}

public function destroy($id)
{
    Guru::findOrFail($id)->delete();

    return redirect()->route('guru.index')
                     ->with('success', 'Data guru berhasil dihapus');
}
}