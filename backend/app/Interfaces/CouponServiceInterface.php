<?php

namespace App\Interfaces;

use App\Http\Resources\CouponResource;
use App\Models\Coupon;

interface CouponServiceInterface
{
    /**
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function store(array $data): void;

    /**
     * @param int $couponId
     * @return CouponResource
     */
    public function prepareForExposure(int $couponId): CouponResource;

    /**
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function update(array $data): void;

    /**
     * @param Coupon $coupon
     * @return void
     * @throws \Throwable
     */
    public function destroy(Coupon $coupon): void;

    /**
     * @param array $data
     * @return void
     */
    public function downloadCoupon(array $data): void;

    /**
     * @param array $data
     * @return void
     */
    public function sendCoupon(array $data): void;
}
