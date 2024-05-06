<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Interfaces\OrderServiceInterface;
use App\Models\Order;
use App\Repository\OrderRepositoryInterface;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private readonly OrderRepositoryInterface $orderRepository;
    private readonly OrderServiceInterface $orderService;

    /**
     * @param OrderRepositoryInterface $orderRepository
     * @param OrderServiceInterface $orderService
     */
    public function __construct(OrderRepositoryInterface $orderRepository, OrderServiceInterface $orderService)
    {
        $this->orderRepository = $orderRepository;
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
     * @param Order $orders
     * @return OrderResource
     */
    public function show(Order $orders): OrderResource
    {
        return $this->orderService->prepareForExposure($orders);
    }

    /**
     * Show the form for editing the specified resource.
     * @param Order $orders
     * @return OrderResource
     */
    public function edit(Order $orders): OrderResource
    {
        return $this->orderService->prepareForExposure($orders);
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
