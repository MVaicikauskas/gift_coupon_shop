<?php

namespace App\Http\Resources;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Coupon $coupon */
        $coupon = $this->resource;
        return $coupon->only([
            Coupon::COL_ID,
            Coupon::COL_RECIPIENT_NAME,
            Coupon::COL_WISH,
            Coupon::COL_ACCEPT_PRIVACY_POLICY,
            Coupon::COL_VALUE,
            Coupon::COL_COUPON_DELIVERY,
            Coupon::COL_COUPON_TYPE,
            Coupon::COL_COUPON_STATUS,
            Coupon::COL_CODE,
            Coupon::COL_EXPIRES_AT,
            Coupon::COL_CREATED_AT,
        ]);
    }
}
