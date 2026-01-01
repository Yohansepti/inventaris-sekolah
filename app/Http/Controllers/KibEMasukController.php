<?php

namespace App\Http\Controllers;

use App\Models\KibEMasuk;
use App\Models\KibE;
use App\Models\Guru;
use App\Models\Ruang;
use App\Models\SumberDana;
use Illuminate\Http\Request;

class KibEMasukController extends Controller
{
    public function index()
    {
        $tahun = $request->tahun ?? date('Y');

        $dataE = KibEMasuk::with(['barang', 'guru', 'ruang', 'sumberDana'])
            //->orderBy('tanggal_masuk', 'desc')
            ->where('tahun', $tahun)
            ->get();

        return view('auth.barang-masuk.kib-e.index', compact('dataE', 'tahun'));
    }

    public function create()
    {
        return view('auth.barang-masuk.kib-e.create', [
            'barang' => KibE::all(),
            'guru' => Guru::all(),
            'ruang' => Ruang::all(),
            'sumberDana' => SumberDana::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required',
            'kode_sumber_dana' => 'required',
            'tanggal_masuk' => 'required|date',
            'harga' => 'required|numeric',
            'jumlah' => 'required|integer',
            'keadaan' => 'required',
            'guru_id' => 'required',
            'ruang_kode' => 'required',
            'tahun' => 'required'
        ]);

        KibEMasuk::create($request->all());

        return redirect()
            ->route('kib-e-masuk.index')
            ->with('success', 'Barang masuk KIB E berhasil disimpan');
    }
}
