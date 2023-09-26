<?php

namespace App\Exports;

use App\Models\CompanyEntry;
use Maatwebsite\Excel\Concerns\FromQuery;

class CompanyEntryLevelTwoRankingsExport implements FromQuery
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        return CompanyEntry::orderByAverageLevelTwoRating();
    }
}
