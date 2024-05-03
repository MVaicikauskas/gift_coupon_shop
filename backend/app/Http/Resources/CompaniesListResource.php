<?php

namespace App\Http\Resources;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompaniesListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Company $companies */
        $companies = $this->resource;

        return $companies->only([
            Company::COL_ID,
            Company::COL_NAME,
            Company::COL_EMAIL,
            Company::COL_COMPANY_CODE,
            Company::COL_VAT,
        ]);
    }
}
