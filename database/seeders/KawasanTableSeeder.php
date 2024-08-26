<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kawasan;

class KawasanTableSeeder extends Seeder
{
    public function run()
    {
        Kawasan::create([
            'nama_kawasan' => 'Asia Timur',
            'id_direktorat' => 1, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Kawasan::create([
            'nama_kawasan' => 'Asia Tenggara',
            'id_direktorat' => 1, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Kawasan::create([
            'nama_kawasan' => 'Asia Selatan & Tengah',
            'id_direktorat' => 1, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Kawasan::create([
            'nama_kawasan' => 'Amerika 1',
            'id_direktorat' => 2, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Kawasan::create([
            'nama_kawasan' => 'Eropa 1',
            'id_direktorat' => 2, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Kawasan::create([
            'nama_kawasan' => 'Eropa 2',
            'id_direktorat' => 2, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Kawasan::create([
            'nama_kawasan' => 'Amerika 2',
            'id_direktorat' => 2, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
       
    }
}
