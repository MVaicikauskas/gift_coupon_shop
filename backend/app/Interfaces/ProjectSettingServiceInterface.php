<?php

namespace App\Interfaces;

use App\Http\Resources\PaymentResource;
use App\Http\Resources\ProjectSettingsResource;
use App\Models\Payment;
use App\Models\ProjectSetting;
use App\Repository\PaymentRepositoryInterface;
use App\Repository\ProjectSettingRepositoryInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface ProjectSettingServiceInterface
{
    /**
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function store(array $data): void;

    /**
     * @param ProjectSetting $projectSetting
     * @return ProjectSettingsResource
     */
    public function prepareForExposure(ProjectSetting $projectSetting): ProjectSettingsResource;

    /**
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function update(array $data): void;

    /**
     * @param array $data
     * @param ProjectSettingRepositoryInterface $projectSettingRepository
     * @return ProjectSettingsResource
     */
    public function getProjectSettings(array $data, ProjectSettingRepositoryInterface $projectSettingRepository): ProjectSettingsResource;
}
