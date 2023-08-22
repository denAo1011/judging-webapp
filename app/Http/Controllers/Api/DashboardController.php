<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CompanyEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Get system statisctics
     */
    public function getStatistics(Request $request)
    {
        $numberOfEntries = [
            'total' => CompanyEntry::count(),
            'pending' => CompanyEntry::whereStatus('PENDING')->count(),
            'disapproved' => CompanyEntry::whereStatus('DISAPPROVED')->count(),
            'approved' => CompanyEntry::whereStatus('APPROVED')->count(),
        ];

        return response()
            ->json(['entries' => $numberOfEntries]);
    }

    /**
     * Get company entry scores
     */
    public function getRankings()
    {
        return response()
            ->json([
                'level_one' => CompanyEntry::orderByAverageLevelOneRating()->get(),
                'level_two' => CompanyEntry::orderByAverageLevelTwoRating()->get(),
            ]);
    }
}
