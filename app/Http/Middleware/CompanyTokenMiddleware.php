<?php

namespace App\Http\Middleware;

use App\Models\CompanyToken;
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
        $companyToken = $request->header('Company-Token');

        // check if header exists
        if (!$companyToken) {
            return response()
                ->json(['error' => '[000] Invalid Token Detected'], 400);
        }

        // check if header is tied to a model
        $companyToken = CompanyToken::whereValue($companyToken)->first(); // replace with your logic

        if (!$companyToken) {
            return response()
                ->json(['error' => '[001] Invalid Token Detected'], 404);
        }

        return $next($request);
    }
}
