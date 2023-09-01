<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CompanyJuror;
use App\Http\Requests\StoreCompanyJurorRequest;
use App\Http\Requests\UpdateCompanyJurorRequest;
use App\Http\Resources\CompanyJurorResource;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;

class CompanyJurorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $perPage = request('perPage', 10);

        // Determine the base query based on authentication status
        $query = Auth::check() ? CompanyJuror::query() : CompanyJuror::whereIsCurrent(TRUE);

        // Check if there's a need to paginate or return all results
        // if ($perPage < 0)
        return CompanyJurorResource::collection($query->get());
        // else return CompanyJurorResource::collection($query->paginate($perPage));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyJurorRequest $request, Company $company)
    {
        $companyJuror = $company->companyJurors()
            ->create($request->validated());

        return new CompanyJurorResource($companyJuror);
    }

    /**
     * Display the specified resource.
     */
    public function show(CompanyJuror $companyJuror)
    {
        return new CompanyJurorResource($companyJuror);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyJurorRequest $request, CompanyJuror $companyJuror)
    {
        $companyJuror->update($request->validated());

        return new CompanyJurorResource($companyJuror);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CompanyJuror $companyJuror)
    {
        $companyJuror->delete();

        return response()->noContent();
    }
}
