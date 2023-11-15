<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    // Download all entries
    public function downloadCompanyEntries(Request $request)
    {
        return Excel::download(new \App\Exports\CompanyEntriesExport, 'company_entries.xlsx');
    }

    // Download all entries ranked for level one
    public function downloadCompanyEntryLevelOneRankings(Request $request)
    {
        return Excel::download(new \App\Exports\CompanyEntryLevelOneRankingsExport, 'company_entry_level_one_ranking.xlsx');
    }

    // Download all entries ranked for level two
    public function downloadCompanyEntryLevelTwoRankings(Request $request)
    {
        return Excel::download(new \App\Exports\CompanyEntryLevelTwoRankingsExport, 'company_entry_level_two_ranking.xlsx');
    }

    // Download all company artist votes
    public function downloadCompanyArtistVotes(Request $request)
    {
        return Excel::download(new \App\Exports\CompanyArtistVotesExport, 'company_artist_votes.xlsx');
    }
}
