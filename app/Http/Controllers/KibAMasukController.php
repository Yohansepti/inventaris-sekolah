<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KibAMasuk;
use App\Models\KibA;
use App\Models\Guru;
use App\Models\Ruang;
use App\Models\SumberDana;

class KibAMasukController extends Controller
{

    /* ======================
       CREATE 
       ====================== */
    public function create(Request $request)
    {
        $barangDipilih = null;
        $guruDipilih   = null;

        if ($request->kode_barang) {
            $barangDipilih = KibA::where('kode_barang', $request->kode_barang)->first();
        }

        if ($request->guru_id) {
            $guruDipilih = Guru::find($request->guru_id);
        }

        return view('auth.barang-masuk.kib-a.create', [
            'barang'        => KibA::all(),
            'guru'          => Guru::all(),
            'ruang'         => Ruang::all(),
            'sumberDana'    => SumberDana::all(),
            'barangDipilih' => $barangDipilih,
            'guruDipilih'   => $guruDipilih,
        ]);
    }

    /* ======================
       STORE
       ====================== */
    public function store(Request $request)
    {
        $request->validate([
            'kode_barang'       => 'required',
            'kode_sumber_dana'  => 'required',
            'tanggal_masuk'     => 'required|date',
            'harga'             => 'required|numeric',
            'jumlah'            => 'required|integer',
            'guru_id'           => 'required',
            'ruang_kode'        => 'required',
        ]);

        KibAMasuk::create([
            'kode_barang'       => $request->kode_barang,
            'kode_sumber_dana'  => $request->kode_sumber_dana,
            'tanggal_masuk'     => $request->tanggal_masuk,
            'harga'             => $request->harga,
            'jumlah'            => $request->jumlah,
            'guru_id'           => $request->guru_id,
            'ruang_kode'        => $request->ruang_kode,
            'tahun'             => date('Y'),
        ]);

        return redirect()
    ->route('barang-masuk', ['tab'=>'a'])
    ->with('success', 'Barang masuk berhasil disimpan');
    }

    /* ======================
   EDIT
   ====================== */
public function edit($id)
{
    $data = KibAMasuk::findOrFail($id);

    return view('auth.barang-masuk.kib-a.edit', [
        'data'       => $data,
        'barang'     => KibA::all(),
        'guru'       => Guru::all(),
        'ruang'      => Ruang::all(),
        'sumberDana' => SumberDana::all(),
    ]);
}

/* ======================
   UPDATE
   ====================== */
public function update(Request $request, $id)
{
    $request->validate([
        'kode_barang'       => 'required',
        'kode_sumber_dana'  => 'required',
        'tanggal_masuk'     => 'required|date',
        'harga'             => 'required|numeric',
        'jumlah'            => 'required|integer',
        'guru_id'           => 'required',
        'ruang_kode'        => 'required',
    ]);

    $data = KibAMasuk::findOrFail($id);

    $data->update($request->all());

    return redirect()
        ->route('barang-masuk', ['tab'=>'a'])
        ->with('success', 'Data barang masuk berhasil diperbarui');
}

/* ======================
   DESTROY
   ====================== */
public function destroy($id)
{
    $data = KibAMasuk::findOrFail($id);

    $data->delete();

    return redirect()
        ->route('barang-masuk', ['tab'=>'a'])
        ->with('success', 'Data barang masuk berhasil dihapus');
}

}
