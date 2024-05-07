<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetCompanyRequest;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Interfaces\CompanyServiceInterface;
use App\Models\Company;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CompanyController extends Controller
{
    private readonly CompanyServiceInterface $companyService;

    /**
     * @param CompanyServiceInterface $companyService
     */
    public function __construct(CompanyServiceInterface $companyService)
    {
        $this->companyService = $companyService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return $this->companyService->getCompaniesList();
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreCompanyRequest $request
     * @return void
     * @throws \Throwable
     */
    public function store(StoreCompanyRequest $request): void
    {
        $this->companyService->store($request->validated());
    }

    /**
     * Display the specified resource.
     * @param GetCompanyRequest $request)
     * @return CompanyResource
     */
    public function show(GetCompanyRequest $request): CompanyResource
    {
        return $this->companyService->prepareForExposure($request->validated([Company::COL_ID]));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Company $company
     * @return  CompanyResource
     */
    public function edit(Company $company): CompanyResource
    {
        return $this->companyService->prepareForExposure($company);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateCompanyRequest $request
     * @return void
     * @throws \Throwable
     */
    public function update(UpdateCompanyRequest $request): void
    {
        $this->companyService->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     * @throws \Throwable
     */
    public function destroy(Company $company): void
    {
        $this->companyService->delete($company);
    }
}
