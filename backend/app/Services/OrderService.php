<?php

namespace App\Services;

use App\Actions\StorePayment;
use App\Http\Resources\OrderResource;
use App\Interfaces\OrderServiceInterface;
use App\Interfaces\PaymentServiceInterface;
use App\Models\Order;
use App\Models\Payment;
use App\Repository\OrderRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderService implements OrderServiceInterface
{
    private readonly OrderRepositoryInterface $orderRepository;

    /**
     * @param OrderRepositoryInterface $orderRepository
     */
    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @param array $data
     * @param bool $returnId
     * @param StorePayment $storePayment
     * @return int|null
     * @throws \Exception
     */
    public function store(array $data, bool $returnId = false, StorePayment $storePayment): ?int
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
            $order->{Order::COL_SELECTED_BANK} = $data[Order::COL_SELECTED_BANK];
            $order->save();

            $order->{Order::RELATION_PROJECT}()->attach($data[Order::EXTRA_COL_PROJECT_ID]);

            //Create payment with transaction status = Payment::TRANSACTION_STATUS_ONGOING
            $paymentData = [
                Payment::COL_BANK_NAME => null,
                Payment::COL_BANK_CODE => $order->{Order::COL_SELECTED_BANK},
                Payment::COL_TRANSACTION_STATUS => Payment::TRANSACTION_STATUS_ONGOING,
                Payment::COL_PAYMENT_METHOD => null,
                Payment::RELATED_KEY_ORDER_ID => $order->{Order::COL_ID},
            ];

            $storePayment->handle($paymentData);

            if ($returnId) {
                return $order->{Order::COL_ID};
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw $e;
        }

        return null;
    }

    /**
     * @param int $orderId
     * @return OrderResource
     */
    public function prepareForExposure(int $orderId): OrderResource
    {
        return new OrderResource($this->orderRepository->getModelById($orderId));
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
            $this->orderRepository->getModelById($data[Order::COL_ID])->update([
                Order::COL_RECIPIENT_NAME => $data[Order::COL_RECIPIENT_NAME],
                Order::COL_VALUE => $data[Order::COL_VALUE],
                Order::COL_EMAIL => $data[Order::COL_EMAIL],
                Order::COL_WISH => $data[Order::COL_WISH],
                Order::COL_ACCEPT_PRIVACY_POLICY => boolval(intval($data[Order::COL_ACCEPT_PRIVACY_POLICY])),
                Order::COL_COUPON_TYPE => intval($data[Order::COL_COUPON_TYPE]),
                Order::COL_COUPON_DELIVERY => intval($data[Order::COL_COUPON_DELIVERY]),
                Order::COL_PICKUP_COORDINATES => $data[Order::COL_PICKUP_COORDINATES],
                Order::COL_SELECTED_BANK => $data[Order::COL_SELECTED_BANK],
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
