<?php

namespace App\Http\Controllers;

use App\Http\Requests\DownloadCouponRequest;
use App\Http\Requests\GetCouponRequest;
use App\Http\Requests\SendCouponRequest;
use App\Http\Requests\StoreCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use App\Http\Resources\CouponResource;
use App\Interfaces\CouponServiceInterface;
use App\Models\Coupon;

class CouponController extends Controller
{
    private readonly CouponServiceInterface $couponService;

    /**
     * @param CouponServiceInterface $couponService;
     */
    public function __construct(CouponServiceInterface $couponService)
    {
        $this->couponService = $couponService;
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreCouponRequest $request
     * @return void
     * @throws \Exception
     */
    public function store(StoreCouponRequest $request): void
    {
        $this->couponService->store($request->validated());
    }

    /**
     * Display the specified resource.
     * @param GetCouponRequest $request
     * @return CouponResource
     */
    public function show(GetCouponRequest $request): CouponResource
    {
        return $this->couponService->prepareForExposure($request->validated([Coupon::COL_ID]));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Coupon $coupon
     * @return CouponResource
     */
    public function edit(Coupon $coupon): CouponResource
    {
        return $this->couponService->prepareForExposure($coupon);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateCouponRequest $request
     * @param Coupon $coupon
     * @return void
     * @throws \Exception
     */
    public function update(UpdateCouponRequest $request): void
    {
        $this->couponService->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     * @param Coupon $coupon
     * @return void
     * @throws \Throwable
     */
    public function destroy(Coupon $coupon): void
    {
        $this->couponService->destroy($coupon);
    }

    public function downloadCoupon(DownloadCouponRequest $request)
    {
        return $this->couponService->downloadCoupon($request->validated());
    }

    /**
     * @param SendCouponRequest $request
     * @return void
     */
    public function sendCoupon(SendCouponRequest $request): void
    {
        $this->couponService->sendCoupon($request->validated());
    }
}
