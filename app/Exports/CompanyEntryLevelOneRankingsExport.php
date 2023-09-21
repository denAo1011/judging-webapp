<?php

namespace App\Exports;

use App\Models\CompanyEntry;
use Maatwebsite\Excel\Concerns\FromQuery;

class CompanyEntryLevelOneRankingsExport implements FromQuery
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        return CompanyEntry::orderByAverageLevelOneRating();
    }
}
