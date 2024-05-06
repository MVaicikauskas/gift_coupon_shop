<?php

namespace App\Interfaces;

use App\Http\Resources\PaymentResource;
use App\Http\Resources\ProjectSettingsResource;
use App\Models\Payment;
use App\Models\ProjectSetting;
use App\Models\Template;
use App\Repository\PaymentRepositoryInterface;
use App\Repository\ProjectSettingRepositoryInterface;
use App\Repository\TemplateRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface TemplateServiceInterface
{
    /**
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function store(array $data): void;

    /**
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function update(array $data): void;

    /**
     * @param array $data
     * @param TemplateRepositoryInterface $templateRepository
     * @return AnonymousResourceCollection
     */
    public function getAllTemplates(array $data, TemplateRepositoryInterface $templateRepository): AnonymousResourceCollection;

    /**
     * @param array $data
     * @param TemplateRepositoryInterface $templateRepository
     * @return AnonymousResourceCollection
     */
    public function getAllActiveTemplates(array $data, TemplateRepositoryInterface $templateRepository): AnonymousResourceCollection;

    /**
     * @param array $data
     * @param TemplateRepositoryInterface $templateRepository
     * @return JsonResponse
     */
    public function streamProjectTemplates(array $data, TemplateRepositoryInterface $templateRepository): JsonResponse;
}
