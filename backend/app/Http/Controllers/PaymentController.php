<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetCompanyPaymentsRequest;
use App\Http\Requests\GetPaymentRequest;
use App\Http\Requests\GetProjectPaymentsRequest;
use App\Http\Requests\OrderPaymentRequest;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Interfaces\PaymentServiceInterface;
use App\Models\Payment;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class PaymentController extends Controller
{
    private readonly PaymentServiceInterface $paymentService;

    /**
     * @param PaymentServiceInterface $paymentService
     */
    public function __construct(PaymentServiceInterface $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * Store a newly created resource in storage.
     * @param StorePaymentRequest $request
     * @return void
     * @throws \Exception
     */
    public function store(StorePaymentRequest $request): void
    {
        $this->paymentService->store($request->validated());
    }

    /**
     * Display the specified resource.
     * @param GetPaymentRequest $request
     * @return PaymentResource
     */
    public function show(GetPaymentRequest $request): PaymentResource
    {
        return $this->paymentService->prepareForExposure($request->validated([Payment::COL_ID]));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdatePaymentRequest $request
     * @return void
     * @throws \Exception
     */
    public function update(UpdatePaymentRequest $request): void
    {
        $this->paymentService->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     * @param Payment $payment
     * @return void
     * @throws \Throwable
     */
    public function destroy(Payment $payment): void
    {
        $this->paymentService->destroy($payment);
    }

    /**
     * @param OrderPaymentRequest $request
     * @return string | null
     */
    public function pay(OrderPaymentRequest $request): ?string
    {
        return $this->paymentService->pay($request->validated(), $request->getLocale());
    }

    /**
     * @param GetProjectPaymentsRequest $request
     * @return AnonymousResourceCollection
     */
    public function getProjectPayments(GetProjectPaymentsRequest $request): AnonymousResourceCollection
    {
        return $this->paymentService->getProjectPayments($request->validated());
    }

    /**
     * @param GetCompanyPaymentsRequest $request
     * @return AnonymousResourceCollection
     */
    public function getCompanyPayments(GetCompanyPaymentsRequest $request): AnonymousResourceCollection
    {
        return $this->paymentService->getCompanyPayments($request->validated());
    }

    /**
     * @param Request $request
     * @return void
     * @throws \Exception
     */
    public function confirmPaidOrder(Request $request): void
    {
        Log::info('confirm paid order', ['request' => $request]);
        $this->paymentService->confirmPaidOrder((array)$request);
    }
}
