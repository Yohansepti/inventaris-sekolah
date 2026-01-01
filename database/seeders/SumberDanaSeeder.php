<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SumberDana;

class SumberDanaSeeder extends Seeder
{
    public function run(): void
    {
        SumberDana::insert([
            [
                'kode_sumber_dana' => 'SD01',
                'nama_sumber_dana' => 'Dana BOS'
            ],
            [
                'kode_sumber_dana' => 'SD02',
                'nama_sumber_dana' => 'Hibah'
            ],
        ]);
    }
}
