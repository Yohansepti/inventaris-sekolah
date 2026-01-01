<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KibB extends Model
{
    protected $table = 'kib_b';
    protected $primaryKey = 'kode_barang';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'kode_barang',
        'merk',
        'tipe',
        'ukuran',
        'bahan',
        'keadaan',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'kode_barang', 'kode_barang');
    }
}
