<?php

namespace App\Repository\Eloquent;

use App\Models\Payment;
use App\Repository\PaymentRepositoryInterface;

class PaymentRepository extends BaseRepository implements PaymentRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param Payment $model
     */
    public function __construct(Payment $model)
    {
        parent::__construct($model);
    }
}
