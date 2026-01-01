<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KibB;
use App\Models\Barang;
use App\Models\SumberDana;

class KibBController extends Controller
{
    public function index(Request $request)
    {
        $query = KibB::with('barang');

        if ($request->filled('search')) {
            $query->whereHas('barang', function ($q) use ($request) {
                $q->where('nama_barang', 'like', '%' . $request->search . '%');
            });
        }

        $kibB = $query->get();
        return view('auth.kib_b', compact('kibB'));
    }

    public function create()
    {
         $sumberDana = SumberDana::all();
    return view('auth.kib_b_create', compact('sumberDana'));
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
        'ukuran' => 'required',
        'bahan' => 'required',
        'keadaan' => 'required',
        'kode_sumber_dana' => 'required|exists:sumber_dana,kode_sumber_dana', 
        'harga' => 'required|numeric',
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
            
            KibB::create([
                'kode_barang' => $request->kode_barang,
                'merk'        => $request->merk,
                'tipe'        => $request->tipe,
                'ukuran'      => $request->ukuran,
                'bahan'       => $request->bahan,
                'keadaan'     => $request->keadaan,
            ]);
        });

        return redirect()->route('kib.b')->with('success', 'Barang KIB B berhasil ditambahkan');

    } catch (\Exception $e) {
        return back()->withInput()->withErrors(['error' => 'Gagal menyimpan data: ' . $e->getMessage()]);
    }
}

    public function edit($kode_barang)
    {
        $kibB = KibB::with('barang')->findOrFail($kode_barang);
        $sumberDana = SumberDana::all();
        return view('auth.kib_b_edit', compact('kibB', 'sumberDana'));
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
    'ukuran' => 'required',
    'bahan' => 'required',
    'keadaan' => 'required',
    'kode_sumber_dana' => 'required|exists:sumber_dana,kode_sumber_dana',
    'harga' => 'required|numeric',
], [
    'nama_barang.regex' => 'Nama barang hanya boleh menggunakan huruf',
]);

        $kibB = KibB::with('barang')->findOrFail($kode_barang);
        $kibB->update([
            'merk' => $request->merk,
            'tipe' => $request->tipe,
            'ukuran' => $request->ukuran,
            'bahan' => $request->bahan,
            'keadaan' => $request->keadaan,
        ]);

        $kibB->barang->update([
            'nama_barang' => $request->nama_barang,
            'kode_sumber_dana' => $request->kode_sumber_dana,
            'harga' => $request->harga,
        ]);

        return redirect()->route('kib.b')->with('success', 'Barang KIB B berhasil diperbarui');
    }

    public function destroy($kode_barang)
    {
        $kibB = KibB::findOrFail($kode_barang);

        $kibB->barang()->delete();
        $kibB->delete();
        return redirect()->route('kib.b')->with('success', 'Barang KIB B berhasil dihapus');
        
    }
}
