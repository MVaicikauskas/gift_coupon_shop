<?php

namespace App\Http\Requests;

use App\Models\Company;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
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
            Company::COL_ID => 'required|integer|exists:companies,' . Company::COL_ID,
            Company::COL_NAME => 'required|string',
            Company::COL_EMAIL => 'required|email',
            Company::COL_COMPANY_CODE => 'required|string',
            Company::COL_VAT => 'required|string',
            Company::EXTRA_COL_USER_ID => 'required|string|exists:users,id',
        ];
    }
}
