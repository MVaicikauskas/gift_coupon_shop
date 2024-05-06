<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetProjectSettingsRequest;
use App\Http\Requests\StoreProjectSettingsRequest;
use App\Http\Requests\UpdateProjectSettingsRequest;
use App\Http\Resources\ProjectSettingsResource;
use App\Interfaces\ProjectSettingServiceInterface;
use App\Models\ProjectSetting;
use App\Repository\ProjectSettingRepositoryInterface;
use App\Services\ProjectSettingService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProjectSettingController extends Controller
{
    private readonly ProjectSettingRepositoryInterface $projectSettingRepository;
    private readonly ProjectSettingServiceInterface $projectSettingService;

    /**
     * @param ProjectSettingRepositoryInterface $projectSettingRepository
     * @param ProjectSettingServiceInterface $projectSettingService
     */
    public function __construct(ProjectSettingRepositoryInterface $projectSettingRepository, ProjectSettingServiceInterface $projectSettingService)
    {
        $this->projectSettingRepository = $projectSettingRepository;
        $this->projectSettingService = $projectSettingService;

    }

    /**
     * Store a newly created resource in storage.
     * @param StoreProjectSettingsRequest $request
     * @return void
     * @throws \Exception
     */
    public function store(StoreProjectSettingsRequest $request): void
    {
        $this->projectSettingService->store($request->validated());
    }

    /**
     * Display the specified resource.
     * @param ProjectSetting $projectSetting
     * @return ProjectSettingsResource
     */
    public function show(ProjectSetting $projectSetting): ProjectSettingsResource
    {
        return $this->projectSettingService->prepareForExposure($projectSetting);
    }

    /**
     * Show the form for editing the specified resource.
     * @param ProjectSetting $projectSetting
     * @return ProjectSettingsResource
     */
    public function edit(ProjectSetting $projectSetting): ProjectSettingsResource
    {
        return $this->projectSettingService->prepareForExposure($projectSetting);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @return void
     * @throws \Exception
     */
    public function update(UpdateProjectSettingsRequest $request): void
    {
        $this->projectSettingService->update($request->validated());
    }

    /**
     * @param GetProjectSettingsRequest $request
     * @return ProjectSettingsResource
     */
    public function getProjectSettings(GetProjectSettingsRequest $request): ProjectSettingsResource
    {
        return $this->projectSettingService->getProjectSettings($request->validated(), $this->projectSettingRepository);
    }
}
