<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';        // nama tabel sesuai migrasi
    protected $primaryKey = 'kode_barang'; // primary key bukan id
    public $incrementing = false;       // karena kode_barang bukan auto-increment
    protected $keyType = 'string';      // tipe primary key adalah string

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'harga',
        'kode_sumber_dana'
    ];


    public function sumberDana()
    {
        return $this->belongsTo(SumberDana::class, 'kode_sumber_dana', 'kode_sumber_dana');
    }

    public function kibA()
    {
        return $this->hasOne(KibA::class, 'kode_barang', 'kode_barang');
    }

    public function kibB()
    {
        return $this->hasOne(KibB::class, 'kode_barang', 'kode_barang');
    }

    public function kibC()
    {
        return $this->hasOne(KibC::class, 'kode_barang', 'kode_barang');
    }

    public function kibD()
    {
        return $this->hasOne(KibD::class, 'kode_barang', 'kode_barang');
    }

    public function kibE()
    {
        return $this->hasOne(KibE::class, 'kode_barang', 'kode_barang');
    }

    public function kibF()
    {
        return $this->hasOne(KibF::class, 'kode_barang', 'kode_barang');
    }
}
