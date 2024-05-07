<?php

namespace App\Interfaces;

use App\Http\Resources\ProjectResource;
use App\Models\Project;
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
     * @param int $projectId
     * @return ProjectResource
     */
    public function prepareForExposure(int $projectId): ProjectResource;

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
     * @return AnonymousResourceCollection
     */
    public function getCompanyProjects(array $data): AnonymousResourceCollection;
}
