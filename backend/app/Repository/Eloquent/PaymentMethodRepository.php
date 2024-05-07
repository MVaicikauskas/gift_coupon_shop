<?php

namespace App\Repository\Eloquent;

use App\Models\PaymentMethod;
use App\Repository\PaymentMethodRepositoryInterface;

class PaymentMethodRepository extends BaseRepository implements PaymentMethodRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param PaymentMethod $model
     */
    public function __construct(PaymentMethod $model)
    {
        parent::__construct($model);
    }
}
