<?php

namespace App\Repository\Eloquent;

use App\Models\Company;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Project;
use App\Repository\PaymentRepositoryInterface;
use Illuminate\Support\Collection;

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

    /**
     * @param int $projectId
     * @return Collection
     */
    public function getProjectPayments(int $projectId): Collection
    {
        return $this->model->with([
            Project::RELATION_ORDERS . '.' . Order::RELATION_PAYMENT
        ])->findOrFail($projectId)->{Project::RELATION_ORDERS};
    }

    /**
     * @param int $companyId
     * @return Collection
     */
    public function getCompanyPayments(int $companyId): Collection
    {
        return $this->model->with([
            Company::RELATION_PROJECTS . '.' . Project::RELATION_ORDERS . '.' . Order::RELATION_PAYMENT
        ])->findOrFail($companyId)->{Company::RELATION_PROJECTS};
    }
}
