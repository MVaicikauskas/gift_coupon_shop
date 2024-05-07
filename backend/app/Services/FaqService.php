<?php

namespace App\Services;

use App\Http\Resources\FaqResource;
use App\Interfaces\FaqServiceInterface;
use App\Models\Faq;
use App\Repository\FaqRepositoryInterface;
use App\Repository\ProjectRepositoryInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FaqService implements FaqServiceInterface
{
    private readonly FaqRepositoryInterface $faqRepository;
    private readonly ProjectRepositoryInterface $projectRepository;

    /**
     * @param FaqRepositoryInterface $faqRepository
     */
    public function __construct(FaqRepositoryInterface $faqRepository, ProjectRepositoryInterface $projectRepository)
    {
        $this->faqRepository = $faqRepository;
        $this->projectRepository = $projectRepository;
    }

    /**
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function store(array $data): void
    {
        DB::beginTransaction();

        try {
            $faq = new Faq();
            $faq->{Faq::COL_HEADER} = $data[Faq::COL_HEADER];
            $faq->{Faq::COL_DESCRIPTION} = $data[Faq::COL_DESCRIPTION];
            $faq->{Faq::COL_POSITION_INDEX} = $data[Faq::COL_POSITION_INDEX];
            $faq->save();

            $faq->{Faq::RELATION_PROJECT}()->attach($data[Faq::EXTRA_COL_PROJECT_ID]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param int $faqId
     * @return FaqResource
     */
    public function prepareForExposure(int $faqId): FaqResource
    {
        return new FaqResource($this->faqRepository->getModelById($faqId));
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
            $this->faqRepository->getModelById($data[Faq::COL_ID])->update([
                Faq::COL_HEADER => $data[Faq::COL_HEADER],
                Faq::COL_DESCRIPTION => $data[Faq::COL_DESCRIPTION],
                Faq::COL_POSITION_INDEX => $data[Faq::COL_POSITION_INDEX],
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param Faq $faq
     * @return void
     * @throws \Throwable
     */
    public function destroy(Faq $faq): void
    {
        DB::beginTransaction();

        try {
            $faq->deleteOrFail();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param array $data
     * @param ProjectRepositoryInterface $projectRepository
     * @return AnonymousResourceCollection
     */
    public function getProjectFaqs(array $data): AnonymousResourceCollection
    {
        return FaqResource::collection($this->projectRepository->getProjectFaqs($data[Faq::EXTRA_COL_PROJECT_ID]));
    }
}
