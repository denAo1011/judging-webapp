<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Entry submission
        Setting::create([
            'key' => 'entry_submission_from',
            'value' => '2023-08-26 00:00:00'
        ]);

        Setting::create([
            'key' => 'entry_submission_to',
            'value' => '2023-09-30 23:59:59'
        ]);

        // Level one voting
        Setting::create([
            'key' => 'level_one_voting_from',
            'value' => '2023-10-01 00:00:00'
        ]);

        Setting::create([
            'key' => 'level_one_voting_to',
            'value' => '2023-10-15 23:59:59'
        ]);

        // Level two voting
        Setting::create([
            'key' => 'level_two_voting_from',
            'value' => '2023-11-01 00:00:00'
        ]);

        Setting::create([
            'key' => 'level_two_voting_to',
            'value' => '2023-11-15 23:59:59'
        ]);
    }
}
