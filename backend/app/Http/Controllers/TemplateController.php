<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetStreamedProjectTemplatesRequest;
use App\Http\Requests\GetTemplatesRequest;
use App\Http\Requests\StoreTemplateRequest;
use App\Http\Requests\UpdateTemplateRequest;
use App\Interfaces\TemplateServiceInterface;
use App\Models\Template;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TemplateController extends Controller
{
    private readonly TemplateServiceInterface $templateService;

    /**
     * @param  $templateRepository
     * @param TemplateServiceInterface $templateService
     */
    public function __construct(TemplateServiceInterface $templateService)
    {
        $this->templateService = $templateService;
    }

    /**
     * @param StoreTemplateRequest $request
     * @return void
     * @throws \Exception
     */
    public function store(StoreTemplateRequest $request): void
    {
        $this->templateService->store($request->validated());
    }

    /**
     * @param UpdateTemplateRequest $request
     * @return void
     * @throws \Exception
     */
    public function update(UpdateTemplateRequest $request): void
    {
        $this->templateService->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     * @param Template $template
     * @return void
     * @throws \Throwable
     */
    public function destroy(Template $template): void
    {
        $this->templateService->destroy($template);
    }

    /**
     * @param GetTemplatesRequest $request
     * @return AnonymousResourceCollection
     */
    public function getAllTemplates(GetTemplatesRequest $request): AnonymousResourceCollection
    {
        return $this->templateService->getAllTemplates($request->validated());
    }

    /**
     * @param GetTemplatesRequest $request
     * @return AnonymousResourceCollection
     */
    public function getAllActiveTemplates(GetTemplatesRequest $request): AnonymousResourceCollection
    {
        return $this->templateService->getAllActiveTemplates($request->validated());
    }

    /**
     * @param GetStreamedProjectTemplatesRequest $request
     * @return JsonResponse
     */
    public function streamProjectTemplates(GetStreamedProjectTemplatesRequest $request): JsonResponse
    {
        return $this->templateService->streamProjectTemplates($request->validated());
    }
}
