<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangMasuk;
use App\Models\Guru;
use App\Models\Ruang;
use App\Models\KibA;
use App\Models\KibB;
use App\Models\KibC;
use App\Models\KibD;
use App\Models\KibE;
use App\Models\KibF;

class BarangMasukController extends Controller
{
    public function index(Request $request)
    {
        $tahun     = $request->get('tahun', date('Y'));
        $filterKib = $request->get('kib', 'all');

        $query = BarangMasuk::with(['barang', 'guru', 'ruang'])
            ->whereYear('tanggal_masuk', $tahun);

        if ($filterKib !== 'all') {
            $query->where('jenis_kib', $filterKib);
        }

        $data = $query
            ->orderByDesc('tanggal_masuk')
            ->get()
            ->map(function ($item) {
                $item->jenis_kib = strtoupper($item->jenis_kib);
                return $item;
            });

        return view('auth.barang-masuk.index', compact(
            'data',
            'tahun',
            'filterKib'
        ));
    }

    public function print(Request $request)
    {
        $tahun = $request->get('tahun', date('Y'));
        $filterKib = $request->get('kib', 'all');

        $query = BarangMasuk::with(['barang', 'guru', 'ruang'])
            ->whereYear('tanggal_masuk', $tahun);

        if ($filterKib !== 'all') {
            $query->where('jenis_kib', $filterKib);
        }

        $data = $query->orderByDesc('tanggal_masuk')->get();

        return view('auth.barang-masuk.print', compact('data', 'tahun', 'filterKib'));
    }

    public function create()
    {
        return view('auth.barang-masuk.create', [
            'guru'  => Guru::all(),
            'ruang' => Ruang::all(),
        ]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'jenis_kib'     => 'required|in:a,b,c,d,e,f',
            'kode_barang'   => 'required',
            'tanggal_masuk' => 'required|date',
            'jumlah'        => 'required|integer|min:1',
            'guru_id'       => 'required',
            'ruang_kode'    => 'required',
        ]);

        BarangMasuk::create([
            'jenis_kib'     => $request->jenis_kib,
            'kode_barang'   => $request->kode_barang,
            'tanggal_masuk' => $request->tanggal_masuk,
            'jumlah'        => $request->jumlah,
            'guru_id'       => $request->guru_id,
            'ruang_kode'    => $request->ruang_kode,
            'tahun'         => date('Y'),
        ]);

        return redirect()
            ->route('barang-masuk.index')
            ->with('success', 'Barang masuk berhasil disimpan');
    }
    
    public function edit($id)
    {
        $data = BarangMasuk::findOrFail($id);

        return view('auth.barang-masuk.edit', [
            'data'  => $data,
            'guru'  => Guru::all(),
            'ruang' => Ruang::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_kib'     => 'required|in:a,b,c,d,e,f',
            'kode_barang'   => 'required',
            'tanggal_masuk' => 'required|date',
            'jumlah'        => 'required|integer|min:1',
            'guru_id'       => 'required',
            'ruang_kode'    => 'required',
        ]);

        $data = BarangMasuk::findOrFail($id);

        $data->update([
            'jenis_kib'     => $request->jenis_kib,
            'kode_barang'   => $request->kode_barang,
            'tanggal_masuk' => $request->tanggal_masuk,
            'jumlah'        => $request->jumlah,
            'guru_id'       => $request->guru_id,
            'ruang_kode'    => $request->ruang_kode,
        ]);

        return redirect()
            ->route('barang-masuk.index')
            ->with('success', 'Data barang masuk berhasil diperbarui');
    }

    public function destroy($id)
    {
        BarangMasuk::findOrFail($id)->delete();

        return redirect()
            ->route('barang-masuk.index')
            ->with('success', 'Data barang masuk berhasil dihapus');
    }

    public function getBarangByKib($jenis)
    {
        $jenis = strtolower($jenis);
        $data = collect();

        switch ($jenis) {
            case 'a': $data = KibA::with('barang')->get(); break;
            case 'b': $data = KibB::with('barang')->get(); break;
            case 'c': $data = KibC::with('barang')->get(); break;
            case 'd': $data = KibD::with('barang')->get(); break;
            case 'e': $data = KibE::with('barang')->get(); break;
            case 'f': $data = KibF::with('barang')->get(); break;
        }

        return response()->json($data->map(function ($item) {
            return [
                'kode_barang' => $item->kode_barang,
                'nama_barang' => $item->barang->nama_barang ?? 'Tanpa Nama',
            ];
        }));
    }

}
