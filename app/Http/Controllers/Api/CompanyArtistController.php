<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyArtistRequest;
use App\Http\Requests\UpdateCompanyArtistRequest;
use App\Http\Resources\CompanyArtistResource;
use App\Models\Company;
use App\Models\CompanyArtist;

class CompanyArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $perPage = request('perPage', 10);

        // if ($perPage < 0) // Return all companies
        return CompanyArtistResource::collection(CompanyArtist::all());
        // else // Return paginated companies
        // return CompanyArtistResource::collection(CompanyArtist::paginate($perPage));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyArtistRequest $request, Company $company)
    {
        $company = $company->companyArtists()
            ->create($request->validated());
        return new CompanyArtistResource($company);
    }

    /**
     * Display the specified resource.
     */
    public function show(CompanyArtist $entry)
    {
        return new CompanyArtistResource($entry);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyArtistRequest $request, CompanyArtist $companyArtist)
    {
        $companyArtist->update($request->validated());

        return new CompanyArtistResource($companyArtist);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CompanyArtist $entry)
    {
        $entry->delete();

        return response()->noContent();
    }
}
