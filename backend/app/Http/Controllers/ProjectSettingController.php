<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetProjectSettingsRequest;
use App\Models\ProjectSetting;
use App\Repository\ProjectSettingRepositoryInterface;
use App\Services\ProjectSettingService;
use Database\Seeders\ProjectSettingsSeeder;
use Illuminate\Http\Request;

class ProjectSettingController extends Controller
{
    private $projectSettingRepository;

    /**
     * @param ProjectSettingRepositoryInterface $projectSettingRepository
     */
    public function __construct(ProjectSettingRepositoryInterface $projectSettingRepository)
    {
        $this->projectSettingRepository = $projectSettingRepository;

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ProjectSetting $projectSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProjectSetting $projectSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProjectSetting $projectSetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProjectSetting $projectSetting)
    {
        //
    }

    /**
     * @param GetProjectSettingsRequest $request
     * @return array
     */
    public function getProjectSettings(GetProjectSettingsRequest $request): array
    {
        return ProjectSettingService::getProjectSettings($request->validated(), $this->projectSettingRepository);
    }
}
