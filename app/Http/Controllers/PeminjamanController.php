<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Guru;        
use App\Models\Ruang;    
use App\Models\Barang; 

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $tahun = $request->tahun ?? date('Y');

        $data = Peminjaman::with(['guru', 'ruang'])
            ->where('tahun', $tahun)
            ->get();

        return view('auth.peminjaman.index', compact('data', 'tahun'));
    }

    public function print(Request $request)
    {
        $tahun = $request->tahun ?? date('Y');

        $data = Peminjaman::with(['guru', 'ruang'])
            ->where('tahun', $tahun)
            ->get();

        return view('auth.peminjaman.print', compact('data', 'tahun'));
    }

    public function create()
    {
         $guru = Guru::all();
    $ruang = Ruang::all();
    $barang = Barang::all();

    return view('auth.peminjaman.create', compact('guru', 'ruang', 'barang'));
    }

    public function edit($id)
    {
        $pinjam = Peminjaman::findOrFail($id);
        return view('auth.peminjaman.edit', compact('pinjam'));
    }

    public function store(Request $request)
{
    $request->validate([
        'tanggal_peminjaman' => 'required',
        'tanggal_pesan' => 'required',
        'guru_id' => 'required',
        'kode_barang' => 'required|exists:barang,kode_barang',
        'jam_pemakaian' => 'required',
        'ruang_kode' => 'required',
    ]);

        $barangItem = Barang::where('kode_barang', $request->kode_barang)->first();

        $jenisKib = null;

if ($barangItem) {
    if ($barangItem->kibA()->exists()) $jenisKib = 'A';
    elseif ($barangItem->kibB()->exists()) $jenisKib = 'B';
    elseif ($barangItem->kibC()->exists()) $jenisKib = 'C';
    elseif ($barangItem->kibD()->exists()) $jenisKib = 'D';
    elseif ($barangItem->kibE()->exists()) $jenisKib = 'E';
    elseif ($barangItem->kibF()->exists()) $jenisKib = 'F';
}






        Peminjaman::create([
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'tanggal_pesan' => $request->tanggal_pesan,
            'guru_id' => $request->guru_id,
            'kode_barang' => $request->kode_barang,
            'jenis_kib' => $jenisKib,
            'jam_pemakaian' => $request->jam_pemakaian,
            'ruang_kode' => $request->ruang_kode,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'tahun' => date('Y'),
            'status' => 'Dipinjam'
        ]);

    return redirect()->route('peminjaman.index')
        ->with('success', 'Data peminjaman berhasil disimpan');
}


    public function update(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:Belum Dikembalikan,Sudah Dikembalikan'
    ]);

    $pinjam = Peminjaman::findOrFail($id);

    $pinjam->update([
        'status' => $request->status == 'Sudah Dikembalikan' ? 'Dikembalikan' : 'Dipinjam',
        'tanggal_pengembalian' => $request->status === 'Sudah Dikembalikan'
            ? now()->toDateString()
            : null
    ]);

    return redirect()->route('peminjaman.index')
        ->with('success', 'Status peminjaman diperbarui');
}

public function destroy($id)
{
    Peminjaman::findOrFail($id)->delete();

    return redirect()->route('peminjaman.index')
        ->with('success', 'Data peminjaman berhasil dihapus');
}

}

