<?php

namespace App\Http\Requests;

use App\Models\Coupon;
use App\Models\Order;
use App\Models\ProjectSetting;
use Illuminate\Foundation\Http\FormRequest;

class SendCouponRequest extends FormRequest
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
            Coupon::EXTRA_COL_PROJECT_ID => 'required|integer|exists:projects,id',
            Coupon::COL_EMAIL => 'required|string',
            Order::COL_ID => 'required|integer|exists:orders,id',
        ];
    }
}
