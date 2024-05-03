<?php

namespace App\Services;

use App\Http\Resources\TemplatesListResource;
use App\Models\Template;
use App\Repository\TemplateRepositoryInterface;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\StreamedResponse;

class TemplateService
{
    /**
     * @param array $data
     */
    public static function store(array $data)
    {
        DB::beginTransaction();

        try {
            $template = new Template();
            $template->{Template::COL_TEMPLATE_KEY} = $data[Template::COL_TEMPLATE_KEY];
            $template->{Template::COL_IS_ACTIVE} = $data[Template::COL_IS_ACTIVE];
            $template->{Template::COL_CONTENT} = $data[Template::COL_CONTENT];
            $template->save();

            $template->{Template::RELATION_PROJECT}()->attach($data[Template::EXTRA_COL_PROJECT_ID]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            abort(500, $e->getMessage());
        }
    }

    /**
     * @param array $data
     * @param TemplateRepositoryInterface $templateRepository
     * @return AnonymousResourceCollection
     */
    public static function getAllTemplates(array $data, TemplateRepositoryInterface $templateRepository): AnonymousResourceCollection
    {
        return TemplatesListResource::collection($templateRepository->allProjectTemplates($data[Template::EXTRA_COL_PROJECT_ID]));
    }

    /**
     * @param array $data
     * @param TemplateRepositoryInterface $templateRepository
     * @return AnonymousResourceCollection
     */
    public static function getAllActiveTemplates(array $data, TemplateRepositoryInterface $templateRepository): AnonymousResourceCollection
    {
        return TemplatesListResource::collection($templateRepository->allActiveProjectTemplates($data[Template::EXTRA_COL_PROJECT_ID]));
    }

    public static function streamProjectTemplates(array $data, TemplateRepositoryInterface $templateRepository): array
    {
        // TODO check if it works
        /** @var Collection $templates */
        $templates = $templateRepository->allActiveProjectTemplates($data[Template::EXTRA_COL_PROJECT_ID]);

        /** @var array $pdfs */
        $pdfs = [];

        foreach ($templates as $template) {
            $pdf = Pdf::loadHTML($template->{Template::COL_CONTENT});

            $pdfs[] = $pdf->download($template->{Template::COL_TEMPLATE_KEY} . '.pdf');
        }

        return $pdfs;
    }
}
