<?php

namespace App\Repository\Eloquent;

use App\Models\Company;
use App\Models\Project;
use App\Repository\ProjectRepositoryInterface;
use Illuminate\Support\Collection;

class ProjectRepository extends BaseRepository implements ProjectRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param Project $model
     */
    public function __construct(Project $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $companyId
     * @return Collection
     */
    public function getAllCompanyProjects(int $companyId): Collection
    {
        return $this->model->with([
            Company::RELATION_PROJECTS
        ])->findOrFail($companyId)->{Company::RELATION_PROJECTS};
    }
}
