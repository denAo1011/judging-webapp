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
            ['name' => 'GMA Network', 'email' => 'contac2t@seeder.com'],
            ['name' => 'TV5', 'email' => 'contact3@seeder.com'],
            ['name' => 'ZOE Broadcasting Network Inc. (Light TV)', 'email' => 'contact4@seeder.com'],
            ['name' => 'Knowledge Channel', 'email' => 'contact5@seeder.com'],
            ['name' => 'NET25', 'email' => 'contac6t@seeder.com'],
            ['name' => 'PTV4', 'email' => 'contact7@seeder.com'],
            ['name' => 'UNTV', 'email' => 'contact8@seeder.com'],
            ['name' => 'INCTV', 'email' => 'contact9@seeder.com'],
            ['name' => 'Eagle Broadcasting Corporation', 'email' => 'contact10@seeder.com'],
            ['name' => 'Intercontinental Broadcasting Corporation', 'email' => 'contact11@seeder.com'],
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
