<?php

namespace App\Interfaces;

use App\Http\Resources\PaymentResource;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\ProjectSettingsResource;
use App\Models\Payment;
use App\Models\Project;
use App\Models\ProjectSetting;
use App\Repository\PaymentRepositoryInterface;
use App\Repository\ProjectRepositoryInterface;
use App\Repository\ProjectSettingRepositoryInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface ProjectServiceInterface
{
    /**
     * @param array $data
     * @return void
     * @throws \Throwable
     */
    public function store(array $data): void;

    /**
     * @param Project $project
     * @return ProjectResource
     */
    public function prepareForExposure(Project $project): ProjectResource;

    /**
     * @param array $data
     * @return void
     * @throws \Throwable
     */
    public function update(array $data): void;

    /**
     * @param Project $project
     * @return void
     * @throws \Throwable
     */
    public function destroy(Project $project): void;

    /**
     * @param array $data
     * @param ProjectRepositoryInterface $projectRepository
     * @return AnonymousResourceCollection
     */
    public function getCompanyProjects(array $data, ProjectRepositoryInterface $projectRepository): AnonymousResourceCollection;
}
