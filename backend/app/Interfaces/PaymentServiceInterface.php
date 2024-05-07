<?php

namespace App\Interfaces;

use App\Http\Resources\PaymentResource;
use App\Models\Payment;
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
     * @param int $paymentId
     * @return PaymentResource
     */
    public function prepareForExposure(int $paymentId): PaymentResource;

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
     * @param string $locale
     * @return string | null
     */
    public function pay(array $data, string $locale): ?string;

    /**
     * @param array $data
     * @return AnonymousResourceCollection
     */
    public function getProjectPayments(array $data): AnonymousResourceCollection;

    /**
     * @param array $data
     * @return AnonymousResourceCollection
     */
    public function getCompanyPayments(array $data): AnonymousResourceCollection;

    /**
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function confirmPaidOrder(array $data): void;
}
