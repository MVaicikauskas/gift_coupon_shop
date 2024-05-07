<?php

namespace App\Http\Requests;

use App\Models\Payment;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentRequest extends FormRequest
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
            Payment::COL_ID => 'required|integer|exists:payments,' . Payment::COL_ID,
            Payment::COL_BANK_NAME => 'required|string',
            Payment::COL_BANK_CODE => 'required|string',
            Payment::COL_TRANSACTION_STATUS => 'required', 'integer',
            Payment::COL_PAYMENT_METHOD => 'required|string',
        ];
    }
}
