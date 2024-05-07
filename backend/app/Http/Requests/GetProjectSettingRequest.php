<?php

namespace App\Http\Requests;

use App\Models\ProjectSetting;
use Illuminate\Foundation\Http\FormRequest;

class GetProjectSettingRequest extends FormRequest
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
            ProjectSetting::COL_ID => 'required|integer|exists:project_settings,' . ProjectSetting::COL_ID,
        ];
    }
}
