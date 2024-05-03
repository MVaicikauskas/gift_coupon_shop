<?php

namespace App\Http\Resources;

use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TemplatesListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Template $templates */
        $templates = $this->resource;

        return $templates->only([
            Template::COL_ID,
            Template::COL_TEMPLATE_KEY,
            Template::COL_IS_ACTIVE,
            Template::COL_CONTENT
        ]);
    }
}
