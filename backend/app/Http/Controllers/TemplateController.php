<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetStreamedProjectTemplatesRequest;
use App\Http\Requests\GetTemplatesRequest;
use App\Http\Requests\StoreTemplateRequest;
use App\Models\Template;
use App\Repository\TemplateRepositoryInterface;
use App\Services\TemplateService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\StreamedResponse;

class TemplateController extends Controller
{
    private readonly TemplateRepositoryInterface $templateRepository;

    /**
     * @param TemplateRepositoryInterface $templateRepository
     */
    public function __construct(TemplateRepositoryInterface $templateRepository)
    {
        $this->templateRepository = $templateRepository;

    }

    /**
     * @param StoreTemplateRequest $request
     * @return void
     */
    public function store(StoreTemplateRequest $request): void
    {
        TemplateService::store($request->validated());
    }

    /**
     * @param GetTemplatesRequest $request
     * @return AnonymousResourceCollection
     */
    public function getAllTemplates(GetTemplatesRequest $request): AnonymousResourceCollection
    {
        return TemplateService::getAllTemplates($request->validated(), $this->templateRepository);
    }

    /**
     * @param GetTemplatesRequest $request
     * @return AnonymousResourceCollection
     */
    public function getAllActiveTemplates(GetTemplatesRequest $request): AnonymousResourceCollection
    {
        return TemplateService::getAllActiveTemplates($request->validated(), $this->templateRepository);
    }

    public function streamProjectTemplates(GetStreamedProjectTemplatesRequest $request): array
    {
        return TemplateService::streamProjectTemplates($request->validated(), $this->templateRepository);
    }
}
