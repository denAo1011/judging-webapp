<?php

namespace App\Exports;

use App\Models\CompanyEntry;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CompanyEntryLevelOneRankingsExport implements FromQuery, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        return CompanyEntry::orderByAverageLevelOneRating();
    }

    public function headings(): array
    {
        return [
            'avg_level_one_rating',
            'id',
            'company_id',
            'email',
            'link',
            'title',
            'premiere_date',
            'day_of_airing',
            'time_of_airing',
            'production_company',
            'producers',
            'executive_producers',
            'directors',
            'writers',
            'synopsis',
            'contact_person',
            'contact_person_email',
            'contact_person_number',
            'status',
            'notes',
            'payment_reference',
            'payment_reference_number',
        ];
    }
}
