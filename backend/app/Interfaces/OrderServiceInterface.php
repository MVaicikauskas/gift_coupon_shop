<?php

namespace App\Interfaces;

use App\Http\Resources\OrderResource;
use App\Models\Order;

interface OrderServiceInterface
{
    /**
     * @param array $data
     * @return int | null
     * @throws \Exception
     */
    public function store(array $data): int |null;

    /**
     * @param int $orderId
     * @return OrderResource
     */
    public function prepareForExposure(int $orderId): OrderResource;

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
