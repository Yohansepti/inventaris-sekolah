<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SumberDana extends Model
{
    protected $table = 'sumber_dana';        
    protected $primaryKey = 'kode_sumber_dana'; 
    public $incrementing = false;            
    protected $keyType = 'string';           

    protected $fillable = [
        'kode_sumber_dana',
        'nama_sumber_dana'
    ];

    // Relasi ke Barang
    public function barangs()
    {
        return $this->hasMany(Barang::class, 'kode_sumber_dana', 'kode_sumber_dana');
    }
}
