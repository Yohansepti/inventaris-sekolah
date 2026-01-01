<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KibDMasuk;
use App\Models\KibD;
use App\Models\Guru;
use App\Models\Ruang;
use App\Models\SumberDana;

class KibDMasukController extends Controller
{
    public function index()
    {
        $tahun = $request->tahun ?? date('Y');

        $dataD = KibDMasuk::with(['barang','guru','ruang','sumberDana'])
                // ->orderBy('tanggal_masuk','desc')
                ->where('tahun', $tahun)
                ->get();

        return view('auth.barang-masuk.kib-d.index', compact('dataD', 'tahun'));
    }

    public function create()
    {
        return view('auth.barang-masuk.kib-d.create', [
            'barang' => KibD::all(),
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
            'keadaan' => 'required',
            'guru_id' => 'required|exists:guru,id',
            'ruang_kode' => 'required',
        ]);

        KibDMasuk::create([
            ...$request->all(),
            'tahun' => date('Y'),
        ]);

        return redirect()
            ->route('kib-d.index')
            ->with('success', 'Barang masuk KIB D berhasil disimpan');
    }
}

