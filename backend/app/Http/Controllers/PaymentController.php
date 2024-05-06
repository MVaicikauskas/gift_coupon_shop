<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetCompanyPaymentsRequest;
use App\Http\Requests\GetProjectPaymentsRequest;
use App\Http\Requests\OrderPaymentRequest;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Interfaces\PaymentServiceInterface;
use App\Models\Payment;
use App\Repository\PaymentRepositoryInterface;
use App\Services\PaymentService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PaymentController extends Controller
{
    private readonly PaymentRepositoryInterface $paymentRepository;
    private readonly PaymentServiceInterface $paymentService;

    /**
     * @param PaymentRepositoryInterface $paymentRepository
     * @param PaymentServiceInterface $paymentService
     */
    public function __construct(PaymentRepositoryInterface $paymentRepository, PaymentServiceInterface $paymentService)
    {
        $this->paymentRepository = $paymentRepository;
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
     * @param Payment $payment
     * @return PaymentResource
     */
    public function show(Payment $payment): PaymentResource
    {
        return $this->paymentService->prepareForExposure($payment);
    }

    /**
     * Show the form for editing the specified resource.
     * @param Payment $payment
     * @return PaymentResource
     */
    public function edit(Payment $payment): PaymentResource
    {
        return $this->paymentService->prepareForExposure($payment);
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

    public function pay(OrderPaymentRequest $request)
    {
        return $this->paymentService->pay($request->validated());
    }

    /**
     * @param GetProjectPaymentsRequest $request
     * @return AnonymousResourceCollection
     */
    public function getProjectPayments(GetProjectPaymentsRequest $request): AnonymousResourceCollection
    {
        return $this->paymentService->getProjectPayments($request->validated(), $this->paymentRepository);
    }

    /**
     * @param GetCompanyPaymentsRequest $request
     * @return AnonymousResourceCollection
     */
    public function getCompanyPayments(GetCompanyPaymentsRequest $request): AnonymousResourceCollection
    {
        return $this->paymentService->getCompanyPayments($request->validated(), $this->paymentRepository);
    }
}
