<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KibFMasuk extends Model
{
    protected $table = 'kib_f_masuk';

    protected $fillable = [
        'kode_barang',
        'kode_sumber_dana',
        'tanggal_masuk',
        'harga',
        'jumlah',
        'keadaan',
        'tahun',
        'guru_id',
        'ruang_kode'
    ];

    public function barang()
    {
        return $this->belongsTo(KibF::class, 'kode_barang', 'kode_barang');
    }

    public function sumberDana()
    {
        return $this->belongsTo(SumberDana::class, 'kode_sumber_dana', 'kode_sumber_dana');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    public function ruang()
    {
        return $this->belongsTo(Ruang::class, 'ruang_kode', 'kode_ruangan');
    }
}
