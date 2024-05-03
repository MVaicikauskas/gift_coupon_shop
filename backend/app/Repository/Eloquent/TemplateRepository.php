<?php

namespace App\Repository\Eloquent;

use App\Models\Company;
use App\Models\Project;
use App\Models\Template;
use App\Repository\TemplateRepositoryInterface;
use Illuminate\Support\Collection;

class TemplateRepository extends BaseRepository implements TemplateRepositoryInterface
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

    /**
     * @param int $projectId
     * @return Collection
     */
    public function allProjectTemplates(int $projectId): Collection
    {
        return $this->model->with([
            Template::RELATION_PROJECT
        ])->whereHas(Template::RELATION_PROJECT, function ($q) use ($projectId) {
            $q->where(Project::COL_ID, $projectId);
        })->get();
    }

    /**
     * @param int $projectId
     * @return Collection
     */
    public function allActiveProjectTemplates(int $projectId): Collection
    {
        return $this->model->with([
            Template::RELATION_PROJECT
        ])->whereHas(Template::RELATION_PROJECT, function ($q) use ($projectId) {
            $q->where(Project::COL_ID, $projectId);
        })
            ->where(Template::COL_IS_ACTIVE, 1)
            ->get();
    }
}
