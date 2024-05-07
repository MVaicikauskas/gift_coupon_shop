<?php

namespace App\Http\Resources;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentMethodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var PaymentMethod $paymentMethod */
        $paymentMethod = $this->resource;

        return $paymentMethod->only([
            PaymentMethod::COL_KEY,
            PaymentMethod::COL_IS_ACTIVE
        ]);
    }
}
