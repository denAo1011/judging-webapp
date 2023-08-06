<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubmitTallyRequest;
use App\Models\CompanyEntry;
use App\Models\CompanyEntryScore;
use Illuminate\Http\Request;

class JudgingController extends Controller
{
    /**
     * Class constructor
     */
    public function __construct()
    {
        /**
         * Redundancy, this checks are also done in a middleware
         */

        $companyToken = request()->attributes->get('companyToken', NULL);
        if (!$companyToken)
            return response()
                ->json(['error' => 'Missing Token!'], 500);

        // Check if token was used already
        if ($companyToken->used_at) {
            return response()
                ->json(['error' => 'Token Used Already!'], 422);
        }
    }

    /**
     * List approved entries, exclude entries from token company owner
     */
    public function index(Request $request)
    {
        // Retrieve company token from request
        $companyToken = $request->attributes->get('companyToken', NULL);

        $companyEntries = CompanyEntry::whereStatus('APPROVED')
            ->whereNotIn('company_id', [$companyToken->company_id])
            ->get();

        return response()
            ->json($companyEntries);
    }

    /**
     * Submit the scores per each company entry
     */
    public function submit(SubmitTallyRequest $request)
    {
        // Retrieve company token from request
        $companyToken = $request->attributes->get('companyToken', NULL);

        $tallies = $request->validated()['tallies'];

        foreach ($tallies as $key => $tally) {
            // Retrieve entry
            $companyEntry = CompanyEntry::find($key);

            // Record / Update score
            CompanyEntryScore::updateOrCreate(
                ['company_token_id' => $companyToken->id, 'company_entry_id' => $companyEntry->id],
                [
                    'originality' => $tally['originality'],
                    'adaptability' => $tally['adaptability'],
                    'sustainability' => $tally['sustainability'],
                    'upliftment' => $tally['upliftment'],
                    'total' => ($tally['originality'] + $tally['adaptability'] + $tally['sustainability'] + $tally['upliftment']) / 4
                ]
            );
        }

        // Update company token
        $companyToken->update([
            'used_at' => now(),
            'tallies' => $tallies
        ]);

        return response()
            ->json(['message' => 'Tally Submitted']);
    }
}
