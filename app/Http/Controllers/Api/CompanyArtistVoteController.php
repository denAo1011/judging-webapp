<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyArtistVoteResource;
use App\Models\CompanyArtistVote;
use Illuminate\Http\Request;

class CompanyArtistVoteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $perPage = request('perPage', 10);

        if ($perPage < 0) // Return all companies
            return CompanyArtistVoteResource::collection(CompanyArtistVote::all());
        else // Return paginated companies
            return CompanyArtistVoteResource::collection(CompanyArtistVote::paginate($perPage));
    }
}
