<?php

namespace App\Services;

use App\Http\Resources\CompanyResource;
use App\Interfaces\CompanyServiceInterface;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CompanyService implements CompanyServiceInterface
{
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
            Company::findOrFail($data[Company::COL_ID])->update([
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
     * @param Company $company
     * @return CompanyResource
     */
    public function prepareForExposure(Company $company): CompanyResource
    {
        return new CompanyResource($company);
    }

    /**
     * @param Company $company
     * @return void
     * @throws \Throwable
     */
    public function delete(Company $company): void
    {

    }
}
