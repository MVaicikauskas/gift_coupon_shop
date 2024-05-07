<?php

namespace App\Interfaces;

use App\Models\PaymentMethod;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface PaymentMethodServiceInterface
{
    /**
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function store(array $data): void;

    /**
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function update(array $data): void;

    /**
     * @param PaymentMethod $paymentMethod
     * @return void
     * @throws \Throwable
     */
    public function destroy(PaymentMethod $paymentMethod): void;

    /**
     * @param array $data
     * @return AnonymousResourceCollection
     */
    public function getPaymentMethods(array $data): AnonymousResourceCollection;
}
