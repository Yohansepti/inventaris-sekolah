<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KibD;
use Illuminate\Http\Request;
use App\Models\SumberDana;
use Illuminate\Support\Facades\DB;

class KibDController extends Controller
{
    public function index(Request $request)
    {
        $query = KibD::with('barang');

        if ($request->filled('search')) {
            $query->whereHas('barang', function ($q) use ($request) {
                $q->where('nama_barang', 'like', '%' . $request->search . '%');
            });
        }

        $kibD = $query->get();
        return view('auth.kib_d', compact('kibD'));
    }

    public function create()
    {
        $sumberDana = SumberDana::all();
        return view('auth.kib_d_create', compact('sumberDana'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|unique:barang,kode_barang',
            'nama_barang' => 'required',
            'kode_sumber_dana' => 'required|exists:sumber_dana,kode_sumber_dana', 
            'harga' => 'required|numeric',
            'ukuran' => 'required',
            'bahan' => 'required',
            "nomor_pabrik" => 'required',
            "nomor_mesin" => 'required',
            "nomor_rangka" => 'required',
            'keadaan' => 'required',
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
                
                KibD::create([
                    'kode_barang' => $request->kode_barang,
                    'ukuran'      => $request->ukuran,
                    'bahan'       => $request->bahan,
                    'keadaan'     => $request->keadaan,
                    'nomor_pabrik' => $request->nomor_pabrik,
                    'nomor_mesin'  => $request->nomor_mesin,
                    'nomor_rangka' => $request->nomor_rangka,
                ]);
            });
            
            return redirect()->route('kib.d')->with('success', 'Barang KIB D berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Gagal menyimpan data: ' . $e->getMessage()]);
        }
    }

    public function edit($kode_barang)
    {
        $kibD = KibD::with('barang')->findOrFail($kode_barang);
        $sumberDana = SumberDana::all();
        return view('auth.kib_d_edit', compact('kibD', 'sumberDana'));
    }

    public function update(Request $request, $kode_barang)
{
    $request->validate([
        'nama_barang' => [
                'required',
                'regex:/^[a-zA-Z\s]+$/'
        ],
        'ukuran' => 'required',
        'bahan' => 'required',
        'nomor_pabrik' => 'required',
        'nomor_mesin' => 'required',
        'nomor_rangka' => 'required',
        'kode_sumber_dana' => 'required|exists:sumber_dana,kode_sumber_dana',
        'harga' => 'required|numeric',
        ], [
            'nama_barang.regex' => 'Nama barang hanya boleh menggunakan huruf',
        ]);

    $kibD = KibD::with('barang')->findOrFail($kode_barang);

    // update kib_d
    $kibD->update([
        'ukuran' => $request->ukuran,
        'bahan' => $request->bahan,
        'keadaan' => $request->keadaan,
        'nomor_pabrik' => $request->nomor_pabrik,
        'nomor_mesin' => $request->nomor_mesin,
        'nomor_rangka' => $request->nomor_rangka,
    ]);

    $kibD->barang->update([
        'nama_barang' => $request->nama_barang,
        'kode_sumber_dana' => $request->kode_sumber_dana,
        'harga' => $request->harga,
    ]);

    return redirect()->route('kib.d')->with('success', 'Barang KIB D berhasil diperbarui');
}

    public function destroy($kode_barang)
    {
        $kibD = KibD::findOrFail($kode_barang);
        $kibD->barang()->delete();
        $kibD->delete();
        return redirect()->route('kib.d')->with('success', 'Barang KIB D berhasil dihapus');
    }
}
