<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface PaymentRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param int $projectId
     * @return Collection
     */
    public function getProjectPayments(int $projectId): Collection;

    /**
     * @param int $companyId
     * @return Collection
     */
    public function getCompanyPayments(int $companyId): Collection;

    /**
     * @param int $orderId
     * @return Model
     */
    public function getOrderPayment(int $orderId): Model;
}
