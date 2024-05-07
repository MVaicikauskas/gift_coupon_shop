<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetCompanyProjectsRequest;
use App\Http\Requests\GetProjectRequest;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Interfaces\ProjectServiceInterface;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProjectController extends Controller
{
    private readonly ProjectServiceInterface $projectService;

    /**
     * @param ProjectServiceInterface $projectService
     */
    public function __construct(ProjectServiceInterface $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreProjectRequest $request
     * @return void
     * @throws \Throwable
     */
    public function store(StoreProjectRequest $request): void
    {
        $this->projectService->store($request->validated());
    }

    /**
     * Display the specified resource.
     * @param GetProjectRequest $request
     * @return ProjectResource
     */
    public function show(GetProjectRequest $request): ProjectResource
    {
        return $this->projectService->prepareForExposure($request->validated([Project::COL_ID]));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @return void
     * @throws \Throwable
     */
    public function update(UpdateProjectRequest $request): void
    {
        $this->projectService->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     * @param Project $project
     * @return void
     * @throws \Throwable
     */
    public function destroy(Project $project): void
    {
        $this->projectService->destroy($project);
    }

    /**
     * @param GetCompanyProjectsRequest $request
     * @return AnonymousResourceCollection
     */
    public function getCompanyProjects(GetCompanyProjectsRequest $request): AnonymousResourceCollection
    {
        return $this->projectService->getCompanyProjects($request->validated());
    }
}
