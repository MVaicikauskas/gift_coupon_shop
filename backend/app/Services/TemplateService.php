<?php

namespace App\Services;

use App\Http\Resources\TemplatesListResource;
use App\Interfaces\TemplateServiceInterface;
use App\Models\Order;
use App\Models\Project;
use App\Models\ProjectSetting;
use App\Models\Template;
use App\Repository\TemplateRepositoryInterface;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class TemplateService implements TemplateServiceInterface
{
    /**
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function store(array $data): void
    {
        DB::beginTransaction();

        try {
            $template = new Template();
            $template->{Template::COL_TEMPLATE_KEY} = $data[Template::COL_TEMPLATE_KEY];
            $template->{Template::COL_IS_ACTIVE} = $data[Template::COL_IS_ACTIVE];
            $template->{Template::COL_CONTENT} = $data[Template::COL_CONTENT];
            $template->save();

            $template->{Template::RELATION_PROJECT}()->attach($data[Template::EXTRA_COL_PROJECT_ID]);

            /** @var ProjectSetting $projectSettings */
            $projectSettings = Project::with([
                Project::RELATION_SETTINGS
            ])->findOrFail($data[Template::EXTRA_COL_PROJECT_ID])->{Project::RELATION_SETTINGS}->first();

            /** @var string[] $baseSettings */
            $baseSettings = ProjectSetting::$projectSettings;

            /** @var array $settings */
            $settings = json_decode($projectSettings->{ProjectSetting::COL_SETTINGS});

            foreach ($baseSettings as $baseSetting) {
                switch ($baseSetting) {
                    case ProjectSetting::SETTING_KEY_COUPON_TYPES:
                        $settings->{$baseSetting}[count($settings->{$baseSetting})] = $template->{Template::COL_ID};

                        break;

                    default:
                        $settings->{$baseSetting} = $settings->{$baseSetting};

                        break;
                }
            }

            $projectSettings->update([
                ProjectSetting::COL_SETTINGS => json_encode($settings)
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function update(array $data): void
    {
        DB::beginTransaction();

        try {
            Template::findOrFail($data[Template::COL_ID])->update([
                Template::COL_CONTENT => $data[Template::COL_CONTENT],
                Template::COL_TEMPLATE_KEY => $data[Template::COL_TEMPLATE_KEY],
                Template::COL_IS_ACTIVE => $data[Template::COL_IS_ACTIVE],
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param array $data
     * @param TemplateRepositoryInterface $templateRepository
     * @return AnonymousResourceCollection
     */
    public function getAllTemplates(array $data, TemplateRepositoryInterface $templateRepository): AnonymousResourceCollection
    {
        return TemplatesListResource::collection($templateRepository->allProjectTemplates($data[Template::EXTRA_COL_PROJECT_ID]));
    }

    /**
     * @param array $data
     * @param TemplateRepositoryInterface $templateRepository
     * @return AnonymousResourceCollection
     */
    public function getAllActiveTemplates(array $data, TemplateRepositoryInterface $templateRepository): AnonymousResourceCollection
    {
        return TemplatesListResource::collection($templateRepository->allActiveProjectTemplates($data[Template::EXTRA_COL_PROJECT_ID]));
    }

    /**
     * @param array $data
     * @param TemplateRepositoryInterface $templateRepository
     * @return JsonResponse
     */
    public function streamProjectTemplates(array $data, TemplateRepositoryInterface $templateRepository): JsonResponse
    {
        /** @var Collection $templates */
        $templates = $templateRepository->allActiveProjectTemplates($data[Template::EXTRA_COL_PROJECT_ID]);

        /** @var array $pdfs */
        $pdfs = [];

        foreach ($templates as $template) {
            $htmlContent = $template->{Template::COL_CONTENT};

            if ($data['order']) {
                $whatToReplace = [
                    'coupon_' . Order::COL_RECIPIENT_NAME,
                    'coupon_' . Order::COL_VALUE,
                    'coupon_' . Order::COL_WISH,
                ];

                $replacement = [
                    $data['order'][Order::COL_RECIPIENT_NAME],
                    $data['order'][Order::COL_VALUE],
                    $data['order'][Order::COL_WISH],
                ];

                $htmlContent = str_replace($whatToReplace, $replacement, $htmlContent);
            }

            $pdf = Pdf::loadHTML($htmlContent);

//            $pdfs[] = base64_encode($pdf->stream($template->{Template::COL_TEMPLATE_KEY} . '.pdf'));
            $pdfs[$template->{Template::COL_ID}] = base64_encode($pdf->output());
        }

        return response()->json([
            'templates' => $pdfs,
        ], Response::HTTP_OK);
    }
}
