<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $fillable = [
        'tanggal_peminjaman',
        'tanggal_pesan',
        'tanggal_pengembalian',
        'guru_id',
        'kode_barang',
        'jenis_kib',
        'jam_pemakaian',
        'ruang_kode',
        'status',
        'tahun'
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function ruang()
    {
        return $this->belongsTo(Ruang::class, 'ruang_kode', 'kode_ruangan');
    }

    public function barang()
{
    return $this->belongsTo(Barang::class);
}

}
