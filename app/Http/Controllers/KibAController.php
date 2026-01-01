<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KibA;
use App\Models\Barang;
use App\Models\SumberDana;
use Illuminate\Support\Facades\DB;

class KibAController extends Controller
{
    public function index(Request $request)
    {
        $query = KibA::with('barang');

        if ($request->filled('search')) {
            $query->whereHas('barang', function ($q) use ($request) {
                $q->where('nama_barang', 'like', '%' . $request->search . '%');
            });
        }

        $kibA = $query->get();
        return view('auth.kib_a', compact('kibA'));
    }

    public function create()
    {
        $sumberDana = SumberDana::all();
    return view('auth.kib_a_create', compact('sumberDana'));
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'kode_barang' => [
                'required',
                'unique:kib_a,kode_barang',
                'regex:/^KIBA[0-9]{3}$/'
            ],
            'nama_barang' => [
                'required',
                'regex:/^[a-zA-Z\s]+$/'
            ],
            'ukuran' => 'required',
            'kode_sumber_dana' => 'required|exists:sumber_dana,kode_sumber_dana', 
            'harga' => 'required|numeric',
        ], [
            'kode_barang.regex' => 'Format kode harus KIBA diikuti 3 angka (Contoh: KIBA001)',
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
                KibA::create([
                    'kode_barang' => $request->kode_barang,
                    'ukuran'      => $request->ukuran,
                ]);
            });

            return redirect()->route('kib.a')->with('success', 'Barang KIB A berhasil ditambahkan');

        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Gagal menyimpan data: ' . $e->getMessage()]);
        }
    }

    public function edit($kode_barang)
    {
        $kibA = KibA::with('barang')->findOrFail($kode_barang);
        $sumberDana = SumberDana::all();
        return view('auth.kib_a_edit', compact('kibA', 'sumberDana'));
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

        $kibA = KibA::with('barang')->findOrFail($kode_barang);

        $kibA->update([
            'ukuran' => $request->ukuran,
        ]);
        $kibA->barang->update([
            'nama_barang' => $request->nama_barang,
            'kode_sumber_dana' => $request->kode_sumber_dana,
            'harga' => $request->harga,
        ]);

        return redirect()->route('kib.a')->with('success', 'Barang KIB A berhasil diperbarui');
    }

    public function destroy($kode_barang)
    {
        $kibA = KibA::findOrFail($kode_barang);
        
        $kibA->barang()->delete();
        $kibA->delete();

        return redirect()->route('kib.a')->with('success', 'Barang KIB A berhasil dihapus');
    }
}
