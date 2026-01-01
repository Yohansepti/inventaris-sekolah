<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    protected $table = 'barang_masuk';

    protected $fillable = [
        'jenis_kib',
        'kode_barang',
        'tanggal_masuk',
        'jumlah',
        'guru_id',
        'ruang_kode',
        'tahun',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'kode_barang', 'kode_barang');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function ruang()
    {
        return $this->belongsTo(Ruang::class, 'ruang_kode', 'kode_ruangan');
    }
}
