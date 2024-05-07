<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetPaymentMethodsRequest;
use App\Http\Requests\StorePaymentMethodRequest;
use App\Http\Requests\UpdatePaymentMethodRequest;
use App\Interfaces\PaymentMethodServiceInterface;
use App\Models\PaymentMethod;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PaymentMethodController extends Controller
{
    private readonly PaymentMethodServiceInterface $paymentMethodService;

    /**
     * @param PaymentMethodServiceInterface $paymentMethodService;
     */
    public function __construct(PaymentMethodServiceInterface $paymentMethodService)
    {
        $this->paymentMethodService = $paymentMethodService;
    }

    /**
     * Store a newly created resource in storage.
     * @param StorePaymentMethodRequest $request
     * @return void
     * @throws \Exception
     */
    public function store(StorePaymentMethodRequest $request): void
    {
        $this->paymentMethodService->store($request->validated());
    }

    /**
     * @param UpdatePaymentMethodRequest $request
     * @return void
     * @throws \Exception
     */
    public function update(UpdatePaymentMethodRequest $request): void
    {
        $this->paymentMethodService->update($request->validated());
    }

    /**
     * @param PaymentMethod $paymentMethod
     * @return void
     * @throws \Throwable
     */
    public function destroy(PaymentMethod $paymentMethod): void
    {
        $this->paymentMethodService->destroy($paymentMethod);
    }

    /**
     * @param GetPaymentMethodsRequest $request
     * @return AnonymousResourceCollection
     */
    public function getPaymentMethods(GetPaymentMethodsRequest $request): AnonymousResourceCollection
    {
        return $this->paymentMethodService->getPaymentMethods($request->validated());
    }
}
