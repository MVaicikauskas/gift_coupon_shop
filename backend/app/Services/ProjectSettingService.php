<?php

namespace App\Services;

use App\Models\ProjectSetting;
use App\Repository\ProjectSettingRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProjectSettingService
{
    /**
     * @param array $data
     * @param ProjectSettingRepositoryInterface $projectSettingRepository
     * @return array
     */
    public static function getProjectSettings(array $data, ProjectSettingRepositoryInterface $projectSettingRepository): array
    {
        return $projectSettingRepository->getModelById($data[ProjectSetting::EXTRA_COL_PROJECT_ID])->{ProjectSetting::COL_SETTINGS};
    }
}
