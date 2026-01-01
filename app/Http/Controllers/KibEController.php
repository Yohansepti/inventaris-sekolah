<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KibE;
use Illuminate\Http\Request;
use App\Models\SumberDana;
use Illuminate\Support\Facades\DB;

class KibEController extends Controller
{
    public function index(Request $request)
    {
        $query = KibE::with('barang');

        if ($request->filled('search')) {
            $query->whereHas('barang', function ($q) use ($request) {
                $q->where('nama_barang', 'like', '%' . $request->search . '%');
            });
        }

        $kibE = $query->get();
        return view('auth.kib_e', compact('kibE'));
    }

    public function create()
    {
        $sumberDana = SumberDana::all();
        return view('auth.kib_e_create', compact('sumberDana')  );
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
        'merk' => 'required',
        'tipe' => 'required',
        'bahan' => 'required',
        'kode_sumber_dana' => 'required|exists:sumber_dana,kode_sumber_dana',
        'harga' => 'required|numeric',
        'keadaan' => 'required',
        ]);

        try {
        \DB::transaction(function () use ($request) {
            Barang::create([
                'kode_barang' => $request->kode_barang,
                'nama_barang' => $request->nama_barang,
                'kode_sumber_dana' => $request->kode_sumber_dana,
                'harga' => $request->harga,
            ]);

            KibE::create([
                'kode_barang' => $request->kode_barang,
                'merk'        => $request->merk,
                'tipe'        => $request->tipe,
                'bahan'       => $request->bahan,
                'keadaan'     => $request->keadaan,
            ]);
        });

        return redirect()->route('kib.e')->with('success', 'Barang KIB E berhasil ditambahkan');

    } catch (\Exception $e) {
        return back()->withInput()->withErrors(['error' => 'Gagal menyimpan data: ' . $e->getMessage()]);
    }
}

    public function edit($kode_barang)
    {
        $kibE = KibE::with('barang')->findOrFail($kode_barang);
        $sumberDana = SumberDana::all();
        return view('auth.kib_e_edit', compact('kibE', 'sumberDana'));
    }

    public function update(Request $request, $kode_barang)
    {
        $request->validate([
    'nama_barang' => [
        'required',
        'regex:/^[a-zA-Z\s]+$/'
    ],
    'merk' => 'required',
    'tipe' => 'required',
    'bahan' => 'required',
    'keadaan' => [
        'required',
        'regex:/^[a-zA-Z\s]+$/'
    ],
    'kode_sumber_dana' => 'required|exists:sumber_dana,kode_sumber_dana',
    'harga' => 'required|numeric',
], [
    'nama_barang.regex' => 'Nama barang hanya boleh menggunakan huruf',
    'keadaan.regex' => 'Keadaan hanya boleh menggunakan huruf',
]);
    $kibE = KibE::with('barang')->findOrFail($kode_barang);

    $kibE->update([
        'merk' => $request->merk,
        'tipe' => $request->tipe,
        'bahan' => $request->bahan,
        'keadaan' => $request->keadaan,
    ]);

    $kibE->barang->update([
        'nama_barang' => $request->nama_barang,
        'kode_sumber_dana' => $request->kode_sumber_dana,
        'harga' => $request->harga,
    ]);

    return redirect()->route('kib.e')->with('success', 'Barang KIB E berhasil diperbarui');
}


    public function destroy($kode_barang)
    {
        $kibE = KibE::findOrFail($kode_barang);

        $kibE->barang()->delete();
        $kibE->delete();
        return redirect()->route('kib.e')->with('success', 'Barang KIB E berhasil dihapus');
    }
}
