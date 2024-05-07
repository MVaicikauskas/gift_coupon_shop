<?php

namespace App\Repository\Eloquent;

use App\Models\Company;
use App\Repository\FaqRepositoryInterface;

class FaqRepository extends BaseRepository implements FaqRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param Company $model
     */
    public function __construct(Company $model)
    {
        parent::__construct($model);
    }
}
