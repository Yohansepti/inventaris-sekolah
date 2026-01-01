<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KibEMasuk extends Model
{
    use HasFactory;

    protected $table = 'kib_e_masuk';

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
        return $this->belongsTo(KibE::class, 'kode_barang', 'kode_barang');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id', 'nip');
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
