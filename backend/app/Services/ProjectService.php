<?php

namespace App\Services;

use App\Http\Resources\ProjectResource;
use App\Interfaces\ProjectServiceInterface;
use App\Models\Project;
use App\Repository\ProjectRepositoryInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProjectService implements ProjectServiceInterface
{
    private readonly ProjectRepositoryInterface $projectRepository;

    /**
     * @param ProjectRepositoryInterface $projectRepository
     */
    public function __construct(ProjectRepositoryInterface $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * @param array $data
     * @return void
     * @throws \Throwable
     */
    public function store(array $data): void
    {
        DB::beginTransaction();

        try {
            $project = new Project();
            $project->{Project::COL_NAME} = $data[Project::COL_NAME];
            $project->{Project::COL_IS_ACTIVE} = boolval(intval($data[Project::COL_NAME]));
            $project->save();

            $project->{Project::RELATION_COMPANY}()->attach($data[Project::EXTRA_COL_COMPANY_ID]);

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param int $projectId
     * @return ProjectResource
     */
    public function prepareForExposure(int $projectId): ProjectResource
    {
        return new ProjectResource($this->projectRepository->getModelById($projectId));
    }

    /**
     * @param array $data
     * @return void
     * @throws \Throwable
     */
    public function update(array $data): void
    {
        DB::beginTransaction();

        try {
            $this->projectRepository->getModelById($data[Project::COL_ID])->update([
                Project::COL_NAME => $data[Project::COL_NAME],
                Project::COL_IS_ACTIVE => $data[Project::COL_IS_ACTIVE],
            ]);

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param Project $project
     * @return void
     * @throws \Throwable
     */
    public function destroy(Project $project): void
    {
        DB::beginTransaction();

        try {
            $project->deleteOrFail();

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param array $data
     * @return AnonymousResourceCollection
     */
    public function getCompanyProjects(array $data): AnonymousResourceCollection
    {
        return ProjectResource::collection($this->projectRepository->getAllCompanyProjects($data[Project::EXTRA_COL_COMPANY_ID]));
    }
}
