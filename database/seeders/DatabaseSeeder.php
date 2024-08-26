<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil Seeder yang sudah dibuat untuk Direktori, Kawasan, dan Negara
        $this->call([
            DirektoratTableSeeder::class,
            KawasanTableSeeder::class,
            NegaraTableSeeder::class,
        ]);

       
    }
}
