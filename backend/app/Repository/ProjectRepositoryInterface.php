<?php

namespace App\Repository;

use Illuminate\Support\Collection;

interface ProjectRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param int $companyId
     * @return Collection
     */
    public function getAllCompanyProjects(int $companyId): Collection;

    /**
     * @param int $projectId
     * @return Collection
     */
    public function getProjectFaqs(int $projectId): Collection;
}
