<?php

namespace App\Http\Requests;

use App\Models\Payment;
use Illuminate\Foundation\Http\FormRequest;

class GetCompanyProjectsRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            Payment::EXTRA_COL_COMPANY_ID => 'required|integer|exists:companies,id',
        ];
    }
}
