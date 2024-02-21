<?php

namespace App\Exports;

use App\Models\CompanyEntry;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CompanyEntriesExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return CompanyEntry::all();
    }

    public function headings(): array
    {
        return [
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
