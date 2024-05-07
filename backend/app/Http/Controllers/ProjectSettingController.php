<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetProjectSettingRequest;
use App\Http\Requests\GetProjectSettingsRequest;
use App\Http\Requests\StoreProjectSettingsRequest;
use App\Http\Requests\UpdateProjectSettingsRequest;
use App\Http\Resources\ProjectSettingsResource;
use App\Interfaces\ProjectSettingServiceInterface;
use App\Models\ProjectSetting;
use Illuminate\Http\Request;

class ProjectSettingController extends Controller
{
    private readonly ProjectSettingServiceInterface $projectSettingService;

    /**
     * @param ProjectSettingServiceInterface $projectSettingService
     */
    public function __construct(ProjectSettingServiceInterface $projectSettingService)
    {
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
     * @param GetProjectSettingRequest $request
     * @return ProjectSettingsResource
     */
    public function show(GetProjectSettingRequest $request): ProjectSettingsResource
    {
        return $this->projectSettingService->prepareForExposure($request->validated([ProjectSetting::COL_ID]));
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
        return $this->projectSettingService->getProjectSettings($request->validated());
    }
}
