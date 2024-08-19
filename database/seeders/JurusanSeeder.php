<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tb_jurusan')->insert([
            [
                'jurusan' => 'IPA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jurusan' => 'IPS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jurusan' => 'Bahasa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jurusan' => 'Teknik Komputer dan Jaringan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jurusan' => 'Multimedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
