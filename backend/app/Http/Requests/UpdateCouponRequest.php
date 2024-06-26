<?php

namespace App\Http\Requests;

use App\Models\Coupon;
use App\Models\Order;
use App\Models\Project;
use App\Models\ProjectSetting;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCouponRequest extends FormRequest
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
        /** @var Project $project */
        $project = null;

        /** @var ProjectSetting $projectSettings */
        $projectSettings = null;

        if (! $project = Project::with([
            Project::RELATION_SETTINGS
        ])->findOrFail($this->request->get(Order::EXTRA_COL_PROJECT_ID))) {
            throw new \Exception('Invalid parameters');
        }

        $projectSettings = $project->{Project::RELATION_SETTINGS}->first()->{ProjectSetting::COL_SETTINGS};

        /** @var array $values */
        $values = $projectSettings[ProjectSetting::SETTING_KEY_VALUES];

        /** @var array $couponTypes */
        $couponTypes = $projectSettings[ProjectSetting::SETTING_KEY_COUPON_TYPES];

        return [
            Coupon::COL_ID => 'required|integer|exists:coupons,id',
            Coupon::COL_RECIPIENT_NAME => 'required|string',
            Coupon::COL_VALUE => ['required', 'integer',  Rule::in($values)],
            Coupon::COL_EMAIL => 'required|email',
            Coupon::COL_WISH => 'required|string',
            Coupon::COL_ACCEPT_PRIVACY_POLICY => 'required|accepted',
            Coupon::COL_COUPON_TYPE => ['required', 'integer',  Rule::in($couponTypes)],
            Coupon::COL_COUPON_DELIVERY=> ['required', 'integer',  Rule::in(Order::$deliveryTypes)],
            Coupon::COL_CODE => 'required|string|exists:coupons,code',
            Coupon::EXTRA_COL_PROJECT_ID => 'required|exists:projects,id',
        ];
    }
}
