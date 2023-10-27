<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CompanyArtist;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function __invoke(Request $request, CompanyArtist $companyArtist)
    {
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
        ]);

        return response()->json([
            'message' => 'Your vote has been recorded.'
        ]);
    }
}
