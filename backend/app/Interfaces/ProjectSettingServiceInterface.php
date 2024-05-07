<?php

namespace App\Interfaces;

use App\Http\Resources\ProjectSettingsResource;

interface ProjectSettingServiceInterface
{
    /**
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function store(array $data): void;

    /**
     * @param int $projectSettingId
     * @return ProjectSettingsResource
     */
    public function prepareForExposure(int $projectSettingId): ProjectSettingsResource;

    /**
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function update(array $data): void;

    /**
     * @param array $data
     * @return ProjectSettingsResource
     */
    public function getProjectSettings(array $data): ProjectSettingsResource;
}
