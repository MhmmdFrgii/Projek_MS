<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EkskulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tb_ekskul')->insert([
            [
                'ekskul' => 'Basket',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ekskul' => 'Futsal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ekskul' => 'Paduan Suara',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ekskul' => 'Tari Tradisional',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ekskul' => 'Pencak Silat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
