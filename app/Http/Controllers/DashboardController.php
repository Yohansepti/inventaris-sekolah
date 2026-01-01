<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KibA;
use App\Models\KibB;
use App\Models\KibC;
use App\Models\KibD;
use App\Models\KibE;
use App\Models\KibF;
use App\Models\Peminjaman;
use App\Models\BarangMasuk;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
{
    /* =====================
       JUMLAH BARANG PER KIB
       ===================== */
    $jumlahPerKib = [
        'A' => KibA::count(),
        'B' => KibB::count(),
        'C' => KibC::count(),
        'D' => KibD::count(),
        'E' => KibE::count(),
        'F' => KibF::count(),
    ];

    /* =====================
       TOTAL SEMUA BARANG
       ===================== */
    $totalKib = array_sum($jumlahPerKib);

    /* =====================
       BARANG MASUK BULAN INI
       ===================== */
    $barangMasuk = BarangMasuk::whereMonth('tanggal_masuk', now()->month)
        ->whereYear('tanggal_masuk', now()->year)
        ->sum('jumlah');

    /* =====================
       PEMINJAMAN BULAN INI
       ===================== */
    $peminjaman = Peminjaman::whereIn('status', ['Dipinjam', 'dipinjam', 'Belum Dikembalikan'])
        ->whereMonth('tanggal_peminjaman', now()->month)
        ->whereYear('tanggal_peminjaman', now()->year)
        ->count();

    return view('auth.dashboard', compact(
        'jumlahPerKib',
        'totalKib',
        'barangMasuk',
        'peminjaman'
    ));
}

}
