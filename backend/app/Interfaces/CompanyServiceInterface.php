<?php

namespace App\Interfaces;

use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface CompanyServiceInterface
{
    /**
     * @return AnonymousResourceCollection
     */
    public function getCompaniesList(): AnonymousResourceCollection;

    /**
     * @param array $data
     * @return void
     * @throws \Throwable
     */
    public function store(array $data): void;

    /**
     * @param array $data
     * @return void
     * @throws \Throwable
     */
    public function update(array $data): void;

    /**
     * @param int $companyId)
     * @return CompanyResource
     */
    public function prepareForExposure(int $companyId): CompanyResource;

    /**
     * @param Company $company
     * @return void
     * @throws \Throwable
     */
    public function delete(Company $company): void;
}
