<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanyEntriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();

        foreach ($companies as $company) {
            $company->companyEntries()
                ->create([
                    'email' => fake()->email(),
                    'link' => 'https://www.youtube.com/watch?v=XToA-1dZYWA&list=RDdglBgJSMr-E&index=10&ab_channel=SunkissedLolaVEVO',
                    'title' => fake()->sentence(),
                    'premiere_date' => fake()->date(),
                    'day_of_airing' => fake()->dayOfWeek(),
                    'time_of_airing' => fake()->time(),
                    'production_company' => fake()->word(),
                    'producers' => fake()->name(),
                    'executive_producers' => fake()->name(),
                    'directors' => fake()->name(),
                    'writers' => fake()->name(),
                    'synopsis' => fake()->paragraph(),
                    'contact_person' => fake()->name(),
                    'contact_person_email' => fake()->email(),
                    'contact_person_number' => fake()->phoneNumber(),
                    'payment_reference' => '',
                    'payment_reference_number' => fake()->uuid(),
                ]);
        }
    }
}
