<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KibA extends Model
{
    protected $table = 'kib_a';
    protected $primaryKey = 'kode_barang';
    public $incrementing = false; 
    public $timestamps = false;

    protected $fillable = [
        'kode_barang',
        'ukuran',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'kode_barang', 'kode_barang');
    }
}
