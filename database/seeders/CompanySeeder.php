<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            ['name' => 'ABS-CBN Corporation', 'email' => 'contact@seeder.com'],
            ['name' => 'GMA Network', 'email' => 'contact@seeder.com'],
            ['name' => 'TV5', 'email' => 'contact@seeder.com'],
            ['name' => 'ZOE Broadcasting Network Inc. (Light TV)', 'email' => 'contact@seeder.com'],
            ['name' => 'Knowledge Channel', 'email' => 'contact@seeder.com'],
            ['name' => 'NET25', 'email' => 'contact@seeder.com'],
            ['name' => 'PTV4', 'email' => 'contact@seeder.com'],
            ['name' => 'UNTV', 'email' => 'contact@seeder.com'],
            ['name' => 'INCTV', 'email' => 'contact@seeder.com'],
            ['name' => 'Eagle Broadcasting Corporation', 'email' => 'contact@seeder.com'],
            ['name' => 'Intercontinental Broadcasting Corporation', 'email' => 'contact@seeder.com'],
        ];

        // create company
        foreach ($companies as $company) {
            Company::create([
                'name' => $company['name'],
                'email' => $company['email'],
            ]);
        }
    }
}
