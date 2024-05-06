<?php

namespace App\Http\Resources;

use App\Models\Coupon;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Project $project */
        $project = $this->resource;

        return $project->only([
            Project::COL_ID,
            Project::COL_NAME,
            Project::COL_IS_ACTIVE,
        ]);
    }
}
