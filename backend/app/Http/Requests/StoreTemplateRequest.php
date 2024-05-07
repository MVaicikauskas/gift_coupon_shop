<?php

namespace App\Http\Requests;

use App\Models\Template;
use Illuminate\Foundation\Http\FormRequest;

class StoreTemplateRequest extends FormRequest
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
            Template::COL_TEMPLATE_KEY => 'required|string',
            Template::COL_IS_ACTIVE => 'required|integer',
            Template::COL_CONTENT => 'required|string',
            Template::EXTRA_COL_PROJECT_ID => 'required|integer|exists:projects,id',
        ];
    }
}
