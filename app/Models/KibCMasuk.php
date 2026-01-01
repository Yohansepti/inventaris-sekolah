<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KibCMasuk extends Model
{
    use HasFactory;

    protected $table = 'kib_c_masuk';

    protected $fillable = [
        'kode_barang',
        'kode_sumber_dana',
        'tanggal_masuk',
        'harga',
        'jumlah',
        'guru_id',
        'ruang_kode',
        'tahun',
    ];

    public function barang()
    {
        return $this->belongsTo(KibC::class, 'kode_barang', 'kode_barang');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }
    public function ruang()
    {
        return $this->belongsTo(Ruang::class, 'ruang_kode', 'kode_ruangan');
    }
    public function sumberDana()
    {
        return $this->belongsTo(SumberDana::class, 'kode_sumber_dana', 'kode_sumber_dana');
    }
}
