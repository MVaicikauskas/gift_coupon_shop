<?php

namespace App\Services;

use App\Http\Resources\PaymentMethodResource;
use App\Interfaces\PaymentMethodServiceInterface;
use App\Models\PaymentMethod;
use App\Repository\PaymentMethodRepositoryInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentMethodService implements PaymentMethodServiceInterface
{
    private readonly PaymentMethodRepositoryInterface $paymentMethodRepository;

    /**
     * @param PaymentMethodRepositoryInterface $PaymentMethodRepository
     */
    public function __construct(PaymentMethodRepositoryInterface $paymentMethodRepository)
    {
        $this->paymentMethodRepository = $paymentMethodRepository;
    }

    /**
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function store(array $data): void
    {
        DB::beginTransaction();

        try {
            $paymentMethod = new PaymentMethod();
            $paymentMethod->{PaymentMethod::COL_KEY} = $data[PaymentMethod::COL_KEY];
            $paymentMethod->{PaymentMethod::COL_IS_ACTIVE} = $data[PaymentMethod::COL_IS_ACTIVE];
            $paymentMethod->save();

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
     * @throws \Exception
     */
    public function update(array $data): void
    {
        DB::beginTransaction();

        try {
            $this->paymentMethodRepository->getModelById($data[PaymentMethod::COL_ID])->update([
                PaymentMethod::COL_KEY => $data[PaymentMethod::COL_KEY],
                PaymentMethod::COL_IS_ACTIVE => $data[PaymentMethod::COL_IS_ACTIVE],
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param PaymentMethod $paymentMethod
     * @return void
     * @throws \Throwable
     */
    public function destroy(PaymentMethod $paymentMethod): void
    {
        DB::beginTransaction();

        try {
            $paymentMethod->deleteOrFail();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param array $data
     * @return AnonymousResourceCollection
     */
    public function getPaymentMethods(array $data): AnonymousResourceCollection
    {
        return PaymentMethodResource::collection($this->paymentMethodRepository->all());
    }
}
