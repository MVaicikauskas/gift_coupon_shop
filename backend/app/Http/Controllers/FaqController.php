<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetFaqRequest;
use App\Http\Requests\GetProjectFaqsRequest;
use App\Http\Requests\StoreFaqRequest;
use App\Http\Requests\UpdateFaqRequest;
use App\Http\Resources\FaqResource;
use App\Interfaces\FaqServiceInterface;
use App\Models\Faq;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FaqController extends Controller
{
    private readonly FaqServiceInterface $faqService;

    /**
     * @param FaqServiceInterface $faqService;
     */
    public function __construct(FaqServiceInterface $faqService)
    {
        $this->faqService = $faqService;
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreFaqRequest $request
     * @return void
     * @throws \Exception
     */
    public function store(StoreFaqRequest $request): void
    {
        $this->faqService->store($request->validated());
    }

    /**
     * @param Faq $faq
     * @return FaqResource
     */
    public function retrieveModel(GetFaqRequest $request): FaqResource
    {
        return $this->faqService->prepareForExposure($request->validated([Faq::COL_ID]), $this->faqRepository);
    }

    /**
     * @param UpdateFaqRequest $request
     * @param Faq $faq
     * @return void
     * @throws \Exception
     */
    public function update(UpdateFaqRequest $request): void
    {
        $this->faqService->update($request->validated());
    }

    /**
     * @param Faq $faq
     * @return void
     * @throws \Throwable
     */
    public function destroy(Faq $faq): void
    {
        $this->faqService->destroy($faq);
    }

    /**
     * @param GetProjectFaqsRequest $request
     * @return AnonymousResourceCollection
     */
    public function getProjectFaqs(GetProjectFaqsRequest $request): AnonymousResourceCollection
    {
        return $this->faqService->getProjectFaqs($request->validated(), $this->projectRepository);
    }
}
