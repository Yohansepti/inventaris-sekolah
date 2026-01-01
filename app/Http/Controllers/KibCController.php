<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\KibC;
use App\Models\SumberDana;
use Illuminate\Support\Facades\DB;

class KibCController extends Controller
{
    public function index(Request $request)
    {
        $query = KibC::with('barang');

        if ($request->filled('search')) {
            $query->whereHas('barang', function ($q) use ($request) {
                $q->where('nama_barang', 'like', '%' . $request->search . '%');
            });
        }

        $kibC = $query->get();
        return view('auth.kib_c', compact('kibC'));
    }

    public function create()
    {
        $sumberDana = SumberDana::all();
    return view('auth.kib_c_create', compact('sumberDana'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => [
                'required',
                'unique:kib_c,kode_barang',
                'regex:/^KIBC[0-9]{3}$/'
            ],
            'nama_barang' => [
                'required',
                'regex:/^[a-zA-Z\s]+$/'
            ],
            'ukuran' => 'required',
            'kode_sumber_dana' => 'required|exists:sumber_dana,kode_sumber_dana', 
            'harga' => 'required|numeric',
        ], [
            'kode_barang.regex' => 'Kode tidak valid',
            'nama_barang.regex' => 'Nama barang hanya boleh menggunakan huruf',
            'kode_sumber_dana.required' => 'Sumber dana wajib dipilih',
        ]);

        try {
            DB::transaction(function () use ($request) {
                Barang::create([
                    'kode_barang' => $request->kode_barang,
                    'nama_barang' => $request->nama_barang,
                    'kode_sumber_dana' => $request->kode_sumber_dana,
                    'harga' => $request->harga,
                ]);
                
                KibC::create([
                    'kode_barang' => $request->kode_barang,
                    'ukuran'      => $request->ukuran,
                ]);
            });

            return redirect()->route('kib.c')->with('success', 'Barang KIB C berhasil ditambahkan');

        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Gagal menyimpan data: ' . $e->getMessage()]);
        }
    }

    public function edit($kode_barang)
    {
        $kibC = KibC::with('barang')->findOrFail($kode_barang);
        $sumberDana = SumberDana::all();
        return view('auth.kib_c_edit', compact('kibC', 'sumberDana'));
    }

    public function update(Request $request, $kode_barang)
    {
        $request->validate([
            'nama_barang' => [
                'required',
                'regex:/^[a-zA-Z\s]+$/'
            ],
            'ukuran' => 'required',
            'kode_sumber_dana' => 'required|exists:sumber_dana,kode_sumber_dana',
            'harga' => 'required|numeric',
        ], [
            'nama_barang.regex' => 'Nama barang hanya boleh menggunakan huruf',
        ]);

        $kibC = KibC::with('barang')->findOrFail($kode_barang);

        $kibC->update([
            'ukuran' => $request->ukuran,
        ]);

        $kibC->barang->update([
            'nama_barang' => $request->nama_barang,
            'kode_sumber_dana' => $request->kode_sumber_dana,
            'harga' => $request->harga,
        ]);

        return redirect()->route('kib.c')->with('success', 'Barang KIB C berhasil diperbarui');
    }
    public function destroy($kode_barang)
    {
        $kibC = KibC::findOrFail($kode_barang);

        $kibC->barang()->delete();
        $kibC->delete();
        return redirect()->route('kib.c')->with('success', 'Barang KIB C berhasil dihapus');
    }
}
