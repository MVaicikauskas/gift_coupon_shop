<?php

namespace App\Http\Requests;

use App\Models\Company;
use App\Models\Order;
use App\Models\Project;
use App\Models\ProjectSetting;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     * @throws \Exception
     */
    public function rules(): array
    {
        return [
            Company::COL_NAME => 'required|string|unique:companies,' . Company::COL_NAME,
            Company::COL_EMAIL => 'required|email|unique:companies,' . Company::COL_EMAIL,
            Company::COL_COMPANY_CODE => 'required|string|unique:companies,' . Company::COL_COMPANY_CODE,
            Company::COL_VAT => 'required|string|unique:companies,' . Company::COL_VAT,
            Company::EXTRA_COL_USER_ID => 'required|string|exists:users,id',
        ];
    }
}
