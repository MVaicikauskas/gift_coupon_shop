<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Resources\CompaniesListResource;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Repository\CompanyRepositoryInterface;
use App\Services\CompanyService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CompanyController extends Controller
{
    private readonly CompanyRepositoryInterface $companyRepository;

    /**
     * @param CompanyRepositoryInterface $companyRepository
     */
    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var Collection $companies */
        $companies = CompaniesListResource::collection($this->companyRepository->all());

        // TODO later pass to front view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreCompanyRequest $request
     * @return void
     * @throws \Throwable
     */
    public function store(StoreCompanyRequest $request): void
    {
        CompanyService::store($request->validated());
    }

    /**
     * Display the specified resource.
     * @param Company $company
     * @return CompanyResource
     */
    public function show(Company $company): CompanyResource
    {
        return CompanyService::prepareForExposure($company);
    }

    /**
     * Show the form for editing the specified resource.
     * @param Company $company
     * @return  CompanyResource
     */
    public function edit(Company $company): CompanyResource
    {
        return CompanyService::prepareForExposure($company);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateCompanyRequest $request
     * @param Company $company
     * @return void
     * @throws \Throwable
     */
    public function update(UpdateCompanyRequest $request, Company $company): void
    {
        CompanyService::update($request->validated(), $company);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company): void
    {

    }
}
