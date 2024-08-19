<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganisasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tb_organisasi')->insert([
            [
                'organisasi' => 'OSIS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'organisasi' => 'Pramuka',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'organisasi' => 'PMR',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'organisasi' => 'ROHIS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'organisasi' => 'Paskibra',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
