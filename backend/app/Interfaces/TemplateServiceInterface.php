<?php

namespace App\Interfaces;

use App\Models\Template;
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
     * @param Template $template
     * @return void
     * @throws \Throwable
     */
    public function destroy(Template $template): void;

    /**
     * @param array $data
     * @return AnonymousResourceCollection
     */
    public function getAllTemplates(array $data): AnonymousResourceCollection;

    /**
     * @param array $data
     * @return AnonymousResourceCollection
     */
    public function getAllActiveTemplates(array $data): AnonymousResourceCollection;

    /**
     * @param array $data
     * @return JsonResponse
     */
    public function streamProjectTemplates(array $data): JsonResponse;
}
