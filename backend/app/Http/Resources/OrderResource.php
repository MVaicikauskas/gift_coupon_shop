<?php

namespace App\Http\Resources;

use App\Models\Coupon;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Order $order */
        $order = $this->resource;

        return $order->only([
            Order::COL_ID,
            Order::COL_RECIPIENT_NAME,
            Order::COL_WISH,
            Order::COL_ACCEPT_PRIVACY_POLICY,
            Order::COL_VALUE,
            Order::COL_COUPON_DELIVERY,
            Order::COL_COUPON_TYPE,
            Order::COL_COUPON_STATUS,
            Order::COL_PICKUP_COORDINATES,
            Order::COL_CREATED_AT,
        ]);
    }
}
