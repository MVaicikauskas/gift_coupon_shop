<?php

namespace App\Http\Resources;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Payment $payment */
        $payment = $this->resource;

        return $payment->only([
            Payment::COL_ID,
            Payment::COL_BANK_NAME,
            Payment::COL_BANK_CODE,
            Payment::COL_TRANSACTION_STATUS,
            Payment::COL_PAYMENT_METHOD,
        ]);
    }
}
