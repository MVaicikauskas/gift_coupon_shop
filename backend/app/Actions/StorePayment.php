<?php

namespace App\Actions;

use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StorePayment
{
    public function handle(array $data): void
    {
        DB::beginTransaction();

        try {
            /** @var Payment $payment */
            $payment = new Payment();
            $payment->{Payment::COL_BANK_NAME} = $data[Payment::COL_BANK_NAME];
            $payment->{Payment::COL_BANK_CODE} = $data[Payment::COL_BANK_CODE];
            $payment->{Payment::COL_TRANSACTION_STATUS} = $data[Payment::COL_TRANSACTION_STATUS];
            $payment->{Payment::COL_PAYMENT_METHOD} = $data[Payment::COL_PAYMENT_METHOD];
            $payment->save();

            $payment->{Payment::RELATION_ORDER}()->attach($data[Payment::RELATED_KEY_ORDER_ID]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw $e;
        }
    }
}
