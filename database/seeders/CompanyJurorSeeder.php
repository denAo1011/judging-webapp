<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanyJurorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();

        foreach ($companies as $company) {
            $company->companyJurors()
                ->create([
                    'name' => fake()->name(),
                    'position' => fake()->jobTitle(),
                    'is_current' => TRUE,
                ]);
        }
    }
}
