<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Direktorat;

class DirektoratTableSeeder extends Seeder
{
    public function run()
    {
        Direktorat::create([
            'nama_direktorat' => 'Aspasaf',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Direktorat::create([
            'nama_direktorat' => 'Amerop',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
}
}
