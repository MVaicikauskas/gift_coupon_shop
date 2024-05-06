<?php

namespace App\Http\Requests;

use App\Models\Order;
use App\Models\Project;
use App\Models\ProjectSetting;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOrderRequest extends FormRequest
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
            Order::COL_ID => 'required|integer|exists:orders,' . Order::COL_ID,
            Order::COL_RECIPIENT_NAME => 'required|string',
            Order::COL_VALUE => ['required', 'integer',  Rule::in($values)],
            Order::COL_EMAIL => 'required|email',
            Order::COL_WISH => 'required|string',
            Order::COL_ACCEPT_PRIVACY_POLICY => 'required|accepted',
            Order::COL_COUPON_TYPE => ['required', 'integer',  Rule::in($couponTypes)],
            Order::COL_COUPON_DELIVERY=> ['required', 'integer',  Rule::in(Order::$deliveryTypes)],
            Order::COL_PICKUP_COORDINATES => 'required_if:' . Order::COL_COUPON_DELIVERY . ',' . Order::COUPON_DELIVERY_PHYSICAL_PICKUP,
            Order::EXTRA_COL_PROJECT_ID => 'required|exists:projects,id',
        ];
    }
}
