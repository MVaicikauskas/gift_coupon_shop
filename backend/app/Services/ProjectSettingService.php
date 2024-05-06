<?php

namespace App\Services;

use App\Http\Resources\ProjectSettingsResource;
use App\Interfaces\ProjectSettingServiceInterface;
use App\Models\ProjectSetting;
use App\Repository\ProjectSettingRepositoryInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProjectSettingService implements ProjectSettingServiceInterface
{
    /**
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function store(array $data): void
    {
        DB::beginTransaction();

        try {
            /** @var string[] $projectSettings */
            $projectSettings = ProjectSetting::$projectSettings;

            /** @var array $settings */
            $settings = [];

            foreach ($projectSettings as $projectSetting) {
                switch ($projectSetting) {
                    case ProjectSetting::SETTING_KEY_MONTONIO_ACCESS_KEY:
                    case ProjectSetting::SETTING_KEY_MONTONIO_SECRET_KEY:
                        $settings[$projectSetting] = encrypt($data[$projectSetting]);

                        break;

                    default:
                        $settings[$projectSetting] = $data[$projectSetting];

                        break;
                }
            }

            $projectSettings = new ProjectSetting();
            $projectSettings->{ProjectSetting::COL_SETTINGS} = json_encode($settings);
            $projectSettings->save();

            $projectSettings->{ProjectSetting::RELATION_PROJECT}()->attach($data[ProjectSetting::EXTRA_COL_PROJECT_ID]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param ProjectSetting $projectSetting
     * @return ProjectSettingsResource
     */
    public function prepareForExposure(ProjectSetting $projectSetting): ProjectSettingsResource
    {
        return new ProjectSettingsResource($projectSetting);
    }

    /**
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function update(array $data): void
    {
        DB::beginTransaction();

        try {
            /** @var string[] $projectSettings */
            $projectSettings = ProjectSetting::$projectSettings;

            /** @var array $settings */
            $settings = [];

            foreach ($projectSettings as $projectSetting) {
                switch ($projectSetting) {
                    case ProjectSetting::SETTING_KEY_MONTONIO_ACCESS_KEY:
                    case ProjectSetting::SETTING_KEY_MONTONIO_SECRET_KEY:
                        $settings[$projectSetting] = encrypt($data[$projectSetting]);

                        break;

                    default:
                        $settings[$projectSetting] = $data[$projectSetting];

                        break;
                }
            }

            ProjectSetting::findOrFail($data[ProjectSetting::COL_ID])->update([
                ProjectSetting::COL_SETTINGS => json_encode($settings),
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param array $data
     * @param ProjectSettingRepositoryInterface $projectSettingRepository
     * @return ProjectSettingsResource
     */
    public function getProjectSettings(array $data, ProjectSettingRepositoryInterface $projectSettingRepository): ProjectSettingsResource
    {
        return new ProjectSettingsResource($projectSettingRepository->getModelById($data[ProjectSetting::EXTRA_COL_PROJECT_ID]));
    }
}
