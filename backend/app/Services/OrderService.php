<?php

namespace App\Services;

use App\Http\Resources\OrderResource;
use App\Interfaces\OrderServiceInterface;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderService implements OrderServiceInterface
{
    /**
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function store(array $data): void
    {
        DB::beginTransaction();

        try {
            $order = new Order();
            $order->{Order::COL_RECIPIENT_NAME} = $data[Order::COL_RECIPIENT_NAME];
            $order->{Order::COL_VALUE} = $data[Order::COL_VALUE];
            $order->{Order::COL_EMAIL} = $data[Order::COL_EMAIL];
            $order->{Order::COL_WISH} = $data[Order::COL_WISH];
            $order->{Order::COL_ACCEPT_PRIVACY_POLICY} = boolval(intval($data[Order::COL_ACCEPT_PRIVACY_POLICY]));
            $order->{Order::COL_COUPON_TYPE} = intval($data[Order::COL_COUPON_TYPE]);
            $order->{Order::COL_COUPON_DELIVERY} = intval($data[Order::COL_COUPON_DELIVERY]);
            $order->{Order::COL_PICKUP_COORDINATES} = $data[Order::COL_PICKUP_COORDINATES];
            $order->save();

            $order->{Order::RELATION_PROJECT}()->attach($data[Order::EXTRA_COL_PROJECT_ID]);

            // TODO might be necessary to add here payment process and after successful payment create new coupon and pass it to front

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param Order $order
     * @return OrderResource
     */
    public function prepareForExposure(Order $order): OrderResource
    {
        return new OrderResource($order);
    }

    /**
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function update(array $data): void
    {
        DB::beginTransaction();

        try {
            Order::findOrFail($data[Order::COL_ID])->update([
                Order::COL_RECIPIENT_NAME => $data[Order::COL_RECIPIENT_NAME],
                Order::COL_VALUE => $data[Order::COL_VALUE],
                Order::COL_EMAIL => $data[Order::COL_EMAIL],
                Order::COL_WISH => $data[Order::COL_WISH],
                Order::COL_ACCEPT_PRIVACY_POLICY => boolval(intval($data[Order::COL_ACCEPT_PRIVACY_POLICY])),
                Order::COL_COUPON_TYPE => intval($data[Order::COL_COUPON_TYPE]),
                Order::COL_COUPON_DELIVERY => intval($data[Order::COL_COUPON_DELIVERY]),
                Order::COL_PICKUP_COORDINATES => $data[Order::COL_PICKUP_COORDINATES],
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param Order $order
     * @return void
     * @throws \Throwable
     */
    public function destroy(Order $order): void
    {
        DB::beginTransaction();

        try {
            $order->deleteOrFail();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw $e;
        }
    }
}
