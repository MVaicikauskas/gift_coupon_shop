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

class StorePaymentRequest extends FormRequest
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
            Payment::COL_BANK_KEY => 'required|string',
            Payment::COL_TRANSACTION_STATUS => 'required', 'integer',
            Payment::EXTRA_COL_PROJECT_ID => 'required', 'integer', 'exists:projects,id',
            Payment::RELATED_KEY_ORDER_ID => 'required', 'integer', 'exists:orders,id',
        ];
    }
}
