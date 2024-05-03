<?php

namespace App\Repository;

use App\Models\Template;
use Illuminate\Support\Collection;

interface TemplateRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param int $projectId
     * @return Collection
     */
    public function allProjectTemplates(int $projectId): Collection;

    /**
     * @param int $projectId
     * @return Collection
     */
    public function allActiveProjectTemplates(int $projectId): Collection;

}
