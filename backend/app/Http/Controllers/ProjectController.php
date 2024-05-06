<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetCompanyProjectsRequest;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Interfaces\ProjectServiceInterface;
use App\Models\Project;
use App\Repository\ProjectRepositoryInterface;
use App\Services\ProjectService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProjectController extends Controller
{
    private readonly ProjectRepositoryInterface $projectRepository;
    private readonly ProjectServiceInterface $projectService;

    /**
     * @param ProjectRepositoryInterface $projectRepository
     * @param ProjectServiceInterface $projectService
     */
    public function __construct(ProjectRepositoryInterface $projectRepository, ProjectServiceInterface $projectService)
    {
        $this->projectRepository = $projectRepository;
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
     * @param Project $project
     * @return ProjectResource
     */
    public function show(Project $project): ProjectResource
    {
        return $this->projectService->prepareForExposure($project);
    }

    /**
     * Show the form for editing the specified resource.
     * @param Project $project
     * @return ProjectResource
     */
    public function edit(Project $project): ProjectResource
    {
        return $this->projectService->prepareForExposure($project);
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
        return $this->projectService->getCompanyProjects($request->validated(), $this->projectRepository);
    }
}
