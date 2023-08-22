<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubmitTallyRequest;
use App\Models\CompanyEntry;
use App\Models\CompanyEntryScore;
use App\Models\Setting;
use Illuminate\Http\Request;

class JudgingController extends Controller
{
    /**
     * List approved entries, exclude entries from token company owner
     */
    public function index(Request $request)
    {
        // Retrieve company token from request
        $companyJuror = $request->attributes->get('companyJuror', NULL);

        // Determine level of voting
        $levelOfVoting = Setting::getLevelOfVoting();
        if ($levelOfVoting === 'LEVEL_ONE') {
            $companyEntries = CompanyEntry::whereStatus('APPROVED')
                ->whereNotIn('company_id', [$companyJuror->company_id])
                ->get();
        } elseif ($levelOfVoting === 'LEVEL_TWO') {
            $companyEntries = CompanyEntry::withAvg('companyEntryScores', 'rating1')
                ->whereStatus('APPROVED')
                ->whereNotIn('company_id', [$companyJuror->company_id])
                ->having('companyEntryScores_avg_rating1', '>', 6.9)
                ->inRandomOrder()
                ->get();
        } else $companyEntries = [];

        return response()
            ->json($companyEntries);
    }

    /**
     * Submit the scores per each company entry
     */
    public function submit(SubmitTallyRequest $request)
    {
        // Retrieve company juror from request
        $companyJuror = $request->attributes->get('companyJuror', NULL);

        $tallies = $request->validated()['tallies'];

        // Get level of voting, if null then return error
        $levelOfVoting = Setting::getLevelOfVoting();
        if ($levelOfVoting === NULL) {
            return response()
                ->json(['message' => 'Voting is closed.'], 400);
        }

        foreach ($tallies as $tally) {
            // Retrieve entry
            $companyEntry = CompanyEntry::find($tally['entry_id']);

            // If level of voting is one, then set the rating to level one rating,
            // else set the rating to level two rating
            $payload = [];
            if ($levelOfVoting === 'LEVEL_ONE') {
                $payload['level_one_rating'] = $tally['rating'];
            } else if ($levelOfVoting === 'LEVEL_TWO') {
                $payload['level_two_rating'] = $tally['rating'];
            }

            // Record / Update score
            CompanyEntryScore::updateOrCreate(
                ['company_juror_id' => $companyJuror->id, 'company_entry_id' => $companyEntry->id],
                $payload
            );
        }

        // Update company token
        $companyJuror->update([
            'voted_at' => now(),
            'tallies' => $tallies
        ]);

        return response()
            ->json(['message' => 'Tally Submitted']);
    }
}
