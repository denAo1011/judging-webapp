<?php

namespace App\Http\Controllers\Api;

use App\Models\CompanyToken;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyTokenRequest;
use App\Http\Requests\UpdateCompanyTokenRequest;
use App\Http\Resources\CompanyTokenResource;
use App\Models\Company;
use Illuminate\Support\Facades\Request;

class CompanyTokenController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function regenerate(Request $request, Company $company)
    {
        $companyToken = $company->companyToken()
            ->updateOrCreate(
                ['company_id' => $company->id],
                ['token' => 'placeholder-token'],
            );

        return new CompanyTokenResource($companyToken);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Company $company)
    {
        return new CompanyTokenResource($company->companyToken);
    }
}
