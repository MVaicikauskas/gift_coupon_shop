<?php

namespace App\Http\Requests;

use App\Models\Company;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Project;
use App\Models\ProjectSetting;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProjectRequest extends FormRequest
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
            Project::COL_NAME => 'required|string|unique:projects,name',
            Project::COL_IS_ACTIVE => 'required|boolean',
            Project::EXTRA_COL_COMPANY_ID => 'required|integer|exists:companies,id',
        ];
    }
}