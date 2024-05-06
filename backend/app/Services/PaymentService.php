<?php

namespace App\Services;

use App\Http\Resources\PaymentResource;
use App\Interfaces\PaymentServiceInterface;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Project;
use App\Repository\PaymentRepositoryInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentService implements PaymentServiceInterface
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
            /** @var Payment $payment */
            $payment = new Payment();
            $payment->{Payment::COL_BANK_KEY} = $data[Payment::COL_BANK_KEY];
            $payment->{Payment::COL_TRANSACTION_STATUS} = $data[Payment::COL_TRANSACTION_STATUS];
            $payment->save();

            $payment->{Payment::RELATION_ORDER}()->attach($data[Payment::RELATED_KEY_ORDER_ID]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param Payment $payment
     * @return PaymentResource
     */
    public function prepareForExposure(Payment $payment): PaymentResource
    {
        return new PaymentResource($payment);
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
            Payment::findOrFail($data[Payment::COL_ID])->update([
                Payment::COL_BANK_KEY => $data[Payment::COL_BANK_KEY],
                Payment::COL_TRANSACTION_STATUS => $data[Payment::COL_TRANSACTION_STATUS],
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param Payment $payment
     * @return void
     * @throws \Throwable
     */
    public function destroy(Payment $payment): void
    {
        DB::beginTransaction();

        try {
            $payment->deleteOrFail();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param array $data
     * @return void
     */
    public function pay(array $data): void
    {
        DB::beginTransaction();

        try {


            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            abort(500, $e->getMessage());
        }
    }

    /**
     * @param array $data
     * @param PaymentRepositoryInterface $paymentRepository
     * @return AnonymousResourceCollection
     */
    public function getProjectPayments(array $data, PaymentRepositoryInterface $paymentRepository): AnonymousResourceCollection
    {
        /** @var Collection $projectOrders */
        $projectOrders = $paymentRepository->getProjectPayments($data[Payment::EXTRA_COL_PROJECT_ID]);

        /** @var Collection $payments */
        $payments = new Collection();

        foreach ($projectOrders as $projectOrder) {
            if (!$projectOrder->{Order::RELATION_PAYMENT}) {
                continue;
            }

            $payments->push($projectOrder->{Order::RELATION_PAYMENT}->first());
        }

        return PaymentResource::collection($payments);
    }

    /**
     * @param array $data
     * @param PaymentRepositoryInterface $paymentRepository
     * @return AnonymousResourceCollection
     */
    public function getCompanyPayments(array $data, PaymentRepositoryInterface $paymentRepository): AnonymousResourceCollection
    {
        /** @var Collection $companyProjects */
        $companyProjects = $paymentRepository->getCompanyPayments($data[Payment::EXTRA_COL_COMPANY_ID]);

        /** @var Collection $payments */
        $payments = new Collection();

        foreach ($companyProjects as $project) {
            if (!$project->{Project::RELATION_ORDERS}->count()) {
                continue;
            }

            foreach ($project->{Project::RELATION_ORDERS} as $order) {
                if (!$order->{Order::RELATION_PAYMENT}) {
                    continue;
                }

                $payments->push($order->{Order::RELATION_PAYMENT}->first());
            }
        }

        return PaymentResource::collection($payments);
    }
}
