<?php

namespace App\Interfaces;

use App\Http\Resources\FaqResource;
use App\Models\Faq;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface FaqServiceInterface
{
    /**
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function store(array $data): void;

    /**
     * @param int $faqId
     * @return FaqResource
     */
    public function prepareForExposure(int $faqId): FaqResource;

    /**
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function update(array $data): void;

    /**
     * @param Faq $faq
     * @return void
     * @throws \Throwable
     */
    public function destroy(Faq $faq): void;

    /**
     * @param array $data
     * @return AnonymousResourceCollection
     */
    public function getProjectFaqs(array $data): AnonymousResourceCollection;
}
