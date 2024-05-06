<?php

namespace App\Interfaces;

use App\Http\Resources\CompanyResource;
use App\Models\Company;

interface CompanyServiceInterface
{
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
     * @param Company $company
     * @return CompanyResource
     */
    public function prepareForExposure(Company $company): CompanyResource;

    /**
     * @param Company $company
     * @return void
     * @throws \Throwable
     */
    public function delete(Company $company): void;
}
