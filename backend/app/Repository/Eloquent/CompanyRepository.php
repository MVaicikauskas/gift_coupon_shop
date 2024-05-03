<?php

namespace App\Repository\Eloquent;

use App\Models\Company;
use App\Repository\CompanyRepositoryInterface;

class CompanyRepository extends BaseRepository implements CompanyRepositoryInterface
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
