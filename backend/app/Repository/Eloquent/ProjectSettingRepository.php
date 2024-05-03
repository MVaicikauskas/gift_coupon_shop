<?php

namespace App\Repository\Eloquent;

use App\Models\ProjectSetting;
use App\Repository\ProjectSettingRepositoryInterface;

class ProjectSettingRepository extends BaseRepository implements ProjectSettingRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param ProjectSetting $model
     */
    public function __construct(ProjectSetting $model)
    {
        parent::__construct($model);
    }
}
