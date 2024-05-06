<?php

namespace App\Http\Resources;

use App\Models\Coupon;
use App\Models\Project;
use App\Models\ProjectSetting;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectSettingsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var ProjectSetting $projectSettings */
        $projectSettings = $this->resource;

        $projectSettings = $projectSettings->only([
            ProjectSetting::COL_ID,
            ProjectSetting::COL_SETTINGS,
        ]);

        $projectSettings[ProjectSetting::COL_SETTINGS] = json_decode($projectSettings[ProjectSetting::COL_SETTINGS]);
        $projectSettings[ProjectSetting::COL_SETTINGS]->{ProjectSetting::SETTING_KEY_MONTONIO_ACCESS_KEY} =
            decrypt($projectSettings[ProjectSetting::COL_SETTINGS]->{ProjectSetting::SETTING_KEY_MONTONIO_ACCESS_KEY});
        $projectSettings[ProjectSetting::COL_SETTINGS]->{ProjectSetting::SETTING_KEY_MONTONIO_SECRET_KEY} =
            decrypt($projectSettings[ProjectSetting::COL_SETTINGS]->{ProjectSetting::SETTING_KEY_MONTONIO_SECRET_KEY});

        return $projectSettings;
    }
}
