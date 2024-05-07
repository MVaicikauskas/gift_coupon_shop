<?php

namespace App\Http\Requests;

use App\Models\Faq;
use Illuminate\Foundation\Http\FormRequest;

class GetProjectFaqsRequest extends FormRequest
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
            Faq::EXTRA_COL_PROJECT_ID => 'required|integer|exists:projects,id',
        ];
    }
}
