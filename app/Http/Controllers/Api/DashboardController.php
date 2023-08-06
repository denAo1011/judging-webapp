<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CompanyEntry;
use App\Models\CompanyToken;
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

        $votes = [
            'voted' => CompanyToken::whereHas('companyEntryScores')->count(),
            'notVoted' => CompanyToken::doesntHave('companyEntryScores')->count(),
        ];

        return response()
            ->json([
                'entries' => $numberOfEntries,
                'votes' => $votes
            ]);
    }

    /**
     * Get company entry scores
     */
    public function getRankings()
    {
        $entryScores = CompanyEntry::withCount([
            'companyEntryScores as average_score' => function ($query) {
                $query->select(DB::raw('avg(score)'));
            }
        ])->whereStatus('APPROVED') // Only approved entries are scored
            ->orderBy('average_score', 'desc') // Order by average score descending order
            ->paginate(10);

        return response()
            ->json($entryScores);
    }
}
