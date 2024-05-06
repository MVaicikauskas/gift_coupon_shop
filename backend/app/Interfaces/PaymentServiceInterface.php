<?php

namespace App\Interfaces;

use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use App\Repository\PaymentRepositoryInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface PaymentServiceInterface
{
    /**
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function store(array $data): void;

    /**
     * @param Payment $payment
     * @return PaymentResource
     */
    public function prepareForExposure(Payment $payment): PaymentResource;

    /**
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function update(array $data): void;

    /**
     * @param Payment $payment
     * @return void
     * @throws \Throwable
     */
    public function destroy(Payment $payment): void;

    /**
     * @param array $data
     * @return void
     */
    public function pay(array $data): void;

    /**
     * @param array $data
     * @param PaymentRepositoryInterface $paymentRepository
     * @return AnonymousResourceCollection
     */
    public function getProjectPayments(array $data, PaymentRepositoryInterface $paymentRepository): AnonymousResourceCollection;

    /**
     * @param array $data
     * @param PaymentRepositoryInterface $paymentRepository
     * @return AnonymousResourceCollection
     */
    public function getCompanyPayments(array $data, PaymentRepositoryInterface $paymentRepository): AnonymousResourceCollection;
}
