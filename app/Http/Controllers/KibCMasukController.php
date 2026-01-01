<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KibCMasuk;
use App\Models\KibC;
use App\Models\Guru;
use App\Models\Ruang;
use App\Models\SumberDana;

class KibCMasukController extends Controller
{

    public function create()
    {
        return view('auth.barang-masuk.kib-c.create', [
            'barang' => KibC::all(),
            'guru' => Guru::all(),
            'ruang' => Ruang::all(),
            'sumberDana' => SumberDana::all(),
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
            'guru_id' => 'required|exists:guru,id',
            'ruang_kode' => 'required',
        ]);

        KibCMasuk::create([
            'kode_barang' => $request->kode_barang,
            'kode_sumber_dana' => $request->kode_sumber_dana,
            'tanggal_masuk' => $request->tanggal_masuk,
            'harga' => $request->harga,
            'jumlah' => $request->jumlah,
            'guru_id' => $request->guru_id,
            'ruang_kode' => $request->ruang_kode,
            'tahun' => date('Y'),
        ]);

        return redirect()
    ->route('barang-masuk', ['tab'=>'c'])
    ->with('success', 'Barang masuk berhasil disimpan');
    }
}
