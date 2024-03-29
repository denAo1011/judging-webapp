<?php

namespace App\Http\Controllers\Api;

use App\Models\CompanyEntry;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyEntryRequest;
use App\Http\Requests\UpdateCompanyEntryRequest;
use App\Http\Resources\CompanyEntryResource;
use App\Models\Company;
use App\Models\Setting;

class CompanyEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $perPage = request('perPage', 10);

        // if ($perPage < 0) // Return all companies
        return CompanyEntryResource::collection(CompanyEntry::all());
        // else // Return paginated companies
        // return CompanyEntryResource::collection(CompanyEntry::paginate($perPage));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyEntryRequest $request, Company $company)
    {
        if (Setting::getSubmissionDate() || $request['gateway'] == 'admin') {
            $company = $company->companyEntries()
                ->create($request->validated());
            return new CompanyEntryResource($company);
        } else {
            return response()
                ->json(['message' => 'Submission is closed.'], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CompanyEntry $entry)
    {
        return new CompanyEntryResource($entry);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyEntryRequest $request, CompanyEntry $companyEntry)
    {
        $companyEntry->update($request->validated());

        return new CompanyEntryResource($companyEntry);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CompanyEntry $entry)
    {
        $entry->delete();

        return response()->noContent();
    }
}
