<?php

namespace App\Exports;

use App\Models\CompanyEntry;
use Maatwebsite\Excel\Concerns\FromCollection;

class CompanyEntriesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CompanyEntry::all();
    }
}
