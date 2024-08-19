<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UsersSeeder;
use Database\Seeders\SessionsSeeder;
use Database\Seeders\PasswordResetTokensSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersSeeder::class,
            PasswordResetTokensSeeder::class,
            SessionsSeeder::class,
            KelasSeeder::class,
            JurusanSeeder::class,
            OrganisasiSeeder::class,
            EkskulSeeder::class,
            MapelSeeder::class,
            // Tambahkan seeder lainnya di sini
        ]);
    }
}
