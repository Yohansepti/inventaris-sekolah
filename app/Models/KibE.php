<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KibE extends Model
{
    protected $table = 'kib_e';

    protected $primaryKey = 'kode_barang';
    public $incrementing = false;
    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'kode_barang',
        'merk',
        'bahan',
        'tipe',
        'keadaan',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'kode_barang', 'kode_barang');
    }
}
