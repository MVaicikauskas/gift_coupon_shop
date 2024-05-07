<?php

namespace App\Http\Resources;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FaqResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Faq $faqs */
        $faq = $this->resource;

        return $faq->only([
            Faq::COL_HEADER,
            Faq::COL_DESCRIPTION,
            Faq::COL_POSITION_INDEX
        ]);
    }
}
