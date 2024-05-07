<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetOrderRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Interfaces\OrderServiceInterface;
use App\Models\Order;

class OrderController extends Controller
{
    private readonly OrderServiceInterface $orderService;

    /**
     * @param OrderServiceInterface $orderService
     */
    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreOrderRequest $request
     * @return void
     * @throws \Exception
     */
    public function store(StoreOrderRequest $request): void
    {
        $this->orderService->store($request->validated());
    }

    /**
     * Display the specified resource.
     * @param GetOrderRequest $request
     * @return OrderResource
     */
    public function show(GetOrderRequest $request): OrderResource
    {
        return $this->orderService->prepareForExposure($request->validated([Order::COL_ID]));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateOrderRequest $request
     * @return void
     * @throws \Exception
     */
    public function update(UpdateOrderRequest $request): void
    {
        $this->orderService->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     * @param Order $orders
     * @return void
     * @throws \Throwable
     */
    public function destroy(Order $orders): void
    {
        $this->orderService->destroy($orders);
    }

    /**
     * @param StoreOrderRequest $request
     * @return void
     * @throws \Exception
     */
    public function placeOrder(StoreOrderRequest $request): void
    {
        $this->orderService->store($request->validated());
    }
}
