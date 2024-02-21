<?php

namespace App\Http\Middleware;

use App\Models\CompanyJuror;
use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompanyTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Determine level of voting, else return error
        $levelOfVoting = Setting::getLevelOfVoting();
        if ($levelOfVoting === NULL) {
            return response()
                ->json(['message' => 'Voting is closed.'], 400);
        }

        // Retrieve company token from request
        $jurorToken = $request->header('X-Juror-Token');

        // check if header exists
        if (!$jurorToken) {
            return response()
                ->json(['error' => '[000] Invalid Token Detected'], 400);
        }

        // check if header is tied to a model
        $companyJuror = CompanyJuror::whereToken($jurorToken)->first(); // replace with your logic

        if (!$companyJuror) {
            return response()
                ->json(['error' => '[001] Invalid Token Detected'], 404);
        }

        // Check if token was used already
        if ($companyJuror->voted_at) {
            return response()
                ->json(['error' => '[002] Token Used Already!'], 422);
        }

        // Add company token to request attributes
        $request->attributes->add(['companyJuror' => $companyJuror]);

        return $next($request);
    }
}
