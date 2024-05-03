<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use JetBrains\PhpStorm\NoReturn;

class OrderService
{
    /**
     * @param array $data
     * @return void
     */
    public static function store(array $data): void
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

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            abort(500, $e->getMessage());
        }
    }
}
