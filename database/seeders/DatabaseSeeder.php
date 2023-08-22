<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class. // User Seeder
            CompanySeeder::class, // Company Seeder
            CompanyJurorSeeder::class, // Company Juror Seeder
            SettingSeeder::class, // Setting Seeder
        ]);
    }
}
