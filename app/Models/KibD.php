<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KibD extends Model
{
    protected $table = 'kib_d';
    protected $primaryKey = 'kode_barang';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'kode_barang',
        'ukuran',
        'bahan',
        'keadaan',
        'nomor_pabrik',
        'nomor_mesin',
        'nomor_rangka',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'kode_barang', 'kode_barang');
    }
}
