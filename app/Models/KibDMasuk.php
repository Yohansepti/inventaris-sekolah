<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KibDMasuk extends Model
{
    protected $table = 'kib_d_masuk';

    protected $fillable = [
        'kode_barang',
        'merk',
        'ukuran',
        'bahan',
        'no_pabrik',
        'no_rangka',
        'no_mesin',
        'kode_sumber_dana',
        'tanggal_masuk',
        'harga',
        'keadaan',
        'jumlah',
        'guru_id',
        'ruang_kode',
        'tahun',
    ];

    public function barang()
    {
        return $this->belongsTo(KibD::class, 'kode_barang', 'kode_barang');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
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
