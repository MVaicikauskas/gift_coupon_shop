<?php

namespace App\Http\Requests;

use App\Models\Company;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Project;
use App\Models\ProjectSetting;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectSettingsRequest extends FormRequest
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
        /** @var string[] $projectSettings */
        $projectSettings = ProjectSetting::$projectSettings;

        /** @var array $rules */
        $rules = [];
//        dd($this->request);
        foreach ($projectSettings as $projectSetting) {
            switch ($projectSetting) {
                case ProjectSetting::SETTING_KEY_VALUES:
                    $rules[$projectSetting] = 'required|array';
                    $rules[$projectSetting . '.*'] = 'required|integer';

                    break;

                case ProjectSetting::SETTING_KEY_COUPON_TYPES:
                    $rules[$projectSetting] = 'required|array';
                    $rules[$projectSetting . '.*'] = 'required|string';

                    break;

                case ProjectSetting::SETTING_KEY_EXPIRATION_TERM:
                    $rules[$projectSetting] = 'required|integer';

                    break;

                case ProjectSetting::SETTING_KEY_MONTONIO_ACCESS_KEY:
                case ProjectSetting::SETTING_KEY_MONTONIO_SECRET_KEY:
                    $rules[$projectSetting] = 'required|string';

                    break;
            }
        }

        $rules[ProjectSetting::EXTRA_COL_PROJECT_ID] = 'required|integer|exists:projects,id';
        $rules[ProjectSetting::COL_ID] = 'required|integer|exists:project_settings,id';

        return $rules;
    }
}
