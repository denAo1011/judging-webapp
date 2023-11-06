<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CompanyArtist;
use App\Models\Setting;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function __invoke(Request $request, CompanyArtist $companyArtist)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        if (Setting::getVotingDate()) {
            $ipAddress = $request->ip();
            $userAgent = $request->userAgent();

            // Note: Disabled as per request of the client
            // $vote = $companyArtist->companyArtistVotes()
            //     ->where('ip_address', $ipAddress)
            //     ->where('user_agent', $userAgent)
            //     ->first();

            // if ($vote) {
            //     return response()->json([
            //         'message' => 'You have already voted for this artist.'
            //     ], 400);
            // }

            $companyArtist->companyArtistVotes()->create([
                'ip_address' => $ipAddress,
                'user_agent' => $userAgent,
                'email' => $request->input('email'),
            ]);

            return response()->json([
                'message' => 'Your vote has been recorded.'
            ]);
        } else {
            return response()
                ->json(['message' => 'Voting is closed.'], 400);
        }
    }
}
