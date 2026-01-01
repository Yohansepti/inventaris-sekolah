<?php

namespace App\Http\Controllers;

use App\Models\KibFMasuk;
use App\Models\Guru;
use App\Models\Ruang;
use App\Models\SumberDana;
use App\Models\KibF;
use Illuminate\Http\Request;

class KibFMasukController extends Controller
{
    public function index()
    {
        $tahun = $request->tahun ?? date('Y');

        $dataF = KibFMasuk::with(['barang','guru','ruang','sumberDana'])
            // ->orderBy('tanggal_masuk','desc')
            ->where('tahun', $tahun)
            ->get();

        return view('auth.barang-masuk.kib-f.index', compact('dataF', 'tahun'));
    }

    public function create()
    {
        return view('auth.barang-masuk.kib-f.create', [
            'guru' => Guru::all(),
            'ruang' => Ruang::all(),
            'sumberDana' => SumberDana::all(),
            'barang' => KibF::all()
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
            'ruang_kode' => 'required'
        ]);

        KibFMasuk::create([
            ...$request->all(),
            'tahun' => date('Y')
        ]);

        return redirect()
            ->route('kib-f-masuk.index')
            ->with('success','Barang masuk KIB F berhasil ditambahkan');
    }
}

