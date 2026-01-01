<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KibF; 
use Illuminate\Http\Request;
use App\Models\SumberDana;
use Illuminate\Support\Facades\DB;

class KibFController extends Controller
{
    public function index(Request $request)
    {
        $query = KibF::with('barang');

        if ($request->filled('search')) {
            $query->whereHas('barang', function ($q) use ($request) {
                $q->where('nama_barang', 'like', '%' . $request->search . '%');
            });
        }

        $kibF = $query->get();
        return view('auth.kib_f', compact('kibF'));
    }

    public function create()
    {
        $sumberDana = SumberDana::all();
        return view('auth.kib_f_create', compact('sumberDana'));
    }

public function store(Request $request)
{
    $request->validate([
        'kode_barang' => [
            'required',
            'unique:barang,kode_barang',
            'regex:/^KIBB[0-9]{3}$/'
        ],
        'nama_barang' => [
            'required',
            'regex:/^[a-zA-Z\s]+$/'
        ],
        'kode_sumber_dana' => 'required|exists:sumber_dana,kode_sumber_dana', 
        'harga' => 'required|numeric',
        'merk' => 'nullable|string',
        'tipe' => 'nullable|string',
        'keadaan' => 'required|string',
    ], [
        'kode_barang.regex' => 'Format kode harus KIBB dan 3 angka (Contoh: KIBB001)',
        'nama_barang.regex' => 'Nama barang hanya boleh menggunakan huruf',
        'kode_sumber_dana.required' => 'Sumber dana wajib dipilih',
    ]);

    try {
        \DB::transaction(function () use ($request) {

            Barang::create([
                'kode_barang' => $request->kode_barang,
                'nama_barang' => $request->nama_barang,
                'kode_sumber_dana' => $request->kode_sumber_dana,
                'harga' => $request->harga,
            ]);

            KibF::create([
                'kode_barang' => $request->kode_barang,
                'merk'        => $request->merk,
                'tipe'        => $request->tipe,
                'keadaan'     => $request->keadaan,
            ]);
        });

        return redirect()->route('kib.f')->with('success', 'Barang KIB F berhasil ditambahkan');

    } catch (\Exception $e) {
        return back()->withInput()->withErrors(['error' => 'Gagal menyimpan data: ' . $e->getMessage()]);
    }
}


    public function edit($kode_barang)
    {
        $kibF = KibF::with('barang')->findOrFail($kode_barang);
        $sumberDana = SumberDana::all();
        return view('auth.kib_f_edit', compact('kibF', 'sumberDana'));
    }

    public function update(Request $request, $kode_barang)
    {
        $request->validate([
            'kode_barang' => [
            'required',
            'unique:barang,kode_barang',
            'regex:/^KIBB[0-9]{3}$/'
        ],
        'nama_barang' => [
            'required',
            'regex:/^[a-zA-Z\s]+$/'
        ],
        'kode_sumber_dana' => 'required|exists:sumber_dana,kode_sumber_dana', // Sesuaikan nama input
        'harga' => 'required|numeric',
        'merk' => 'nullable|string',
        'tipe' => 'nullable|string',
        'keadaan' => 'required|string',
        ], [
            'nama_barang.regex' => 'Nama barang hanya boleh menggunakan huruf',
        ]);
    $kibF = KibF::with('barang')->findOrFail($kode_barang);

    $kibF->update([
        'merk' => $request->merk,
        'tipe' => $request->tipe,
        'keadaan' => $request->keadaan,
    ]);

    $kibF->barang->update([
        'nama_barang' => $request->nama_barang,
        'kode_sumber_dana' => $request->kode_sumber_dana,
        'harga' => $request->harga,
    ]);

    return redirect()->route('kib.f')->with('success', 'Barang KIB F berhasil diperbarui');
}

    public function destroy($kode_barang)
    {
        $kibF = KibF::findOrFail($kode_barang);

        $kibF->barang()->delete();
        $kibF->delete();
        return redirect()->route('kib.f')->with('success', 'Barang KIB F berhasil dihapus');
    }
}
