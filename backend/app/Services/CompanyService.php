<?php

namespace App\Services;

use App\Http\Resources\CompaniesListResource;
use App\Http\Resources\CompanyResource;
use App\Interfaces\CompanyServiceInterface;
use App\Models\Company;
use App\Models\User;
use App\Repository\CompanyRepositoryInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CompanyService implements CompanyServiceInterface
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
     * @return AnonymousResourceCollection
     */
    public function getCompaniesList(): AnonymousResourceCollection
    {
        /** @var Collection $companies */
        $companies = CompaniesListResource::collection($this->companyRepository->all());

        return CompanyResource::collection($companies);
    }

    /**
     * @param array $data
     * @return void
     * @throws \Throwable
     */
    public function store(array $data): void
    {
        DB::beginTransaction();

        try {
            $company = new Company();
            $company->{Company::COL_NAME} = $data[Company::COL_NAME];
            $company->{Company::COL_EMAIL} = $data[Company::COL_EMAIL];
            $company->{Company::COL_COMPANY_CODE} = $data[Company::COL_COMPANY_CODE];
            $company->{Company::COL_VAT} = $data[Company::COL_VAT];
            $company->save();

            $company->{Company::RELATION_USER}()->attach(auth()->user()->{User::COL_ID});

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param array $data
     * @return void
     * @throws \Throwable
     */
    public function update(array $data): void
    {
        DB::beginTransaction();

        try {
            $this->companyRepository->getModelById($data[Company::COL_ID])->update([
                Company::COL_NAME => $data[Company::COL_NAME],
                Company::COL_EMAIL => $data[Company::COL_EMAIL],
                Company::COL_COMPANY_CODE => $data[Company::COL_COMPANY_CODE],
                Company::COL_VAT => $data[Company::COL_VAT],
            ]);

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param int $companyId)
     * @return CompanyResource
     */
    public function prepareForExposure(int $companyId): CompanyResource
    {
        return new CompanyResource($this->companyRepository->getModelById($companyId));
    }

    /**
     * @param Company $company
     * @return void
     * @throws \Throwable
     */
    public function delete(Company $company): void
    {
        DB::beginTransaction();

        try {
            $company->deleteOrFail();

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw $e;
        }
    }
}
