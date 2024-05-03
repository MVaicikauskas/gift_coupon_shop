<?php

namespace App\Repository\Eloquent;

use App\Models\Coupon;
use App\Repository\CouponRepositoryInterface;

class CouponRepository extends BaseRepository implements CouponRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param Coupon $model
     */
    public function __construct(Coupon $model)
    {
        parent::__construct($model);
    }
}
