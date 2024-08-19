<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tb_kelas')->insert([
            [
                'kelas' => 'Kelas 10A',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kelas' => 'Kelas 10B',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kelas' => 'Kelas 11A',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kelas' => 'Kelas 11B',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kelas' => 'Kelas 12A',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kelas' => 'Kelas 12B',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
