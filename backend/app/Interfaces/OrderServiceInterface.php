<?php

namespace App\Interfaces;

use App\Http\Resources\OrderResource;
use App\Models\Order;

interface OrderServiceInterface
{
    /**
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function store(array $data): void;

    /**
     * @param Order $order
     * @return OrderResource
     */
    public function prepareForExposure(Order $order): OrderResource;

    /**
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function update(array $data): void;

    /**
     * @param Order $order
     * @return void
     * @throws \Throwable
     */
    public function destroy(Order $order): void;
}
