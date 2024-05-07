<?php

namespace App\Http\Requests;

use App\Models\PaymentMethod;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentMethodRequest extends FormRequest
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
            PaymentMethod::COL_ID => 'required|integer|exists:payment_methods,' . PaymentMethod::COL_ID,
            PaymentMethod::COL_KEY => 'required|string',
            PaymentMethod::COL_IS_ACTIVE => 'required|accepted',
        ];
    }
}
