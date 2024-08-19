<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tb_mapel')->insert([
            [
                'mapel' => 'Matematika',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mapel' => 'Bahasa Indonesia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mapel' => 'Bahasa Inggris',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mapel' => 'Fisika',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mapel' => 'Kimia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
