<?php

namespace Modules\Medicine\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AtcCodeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'name' => $this->name,
            'level' => $this->level,
            'status' => $this->status,
            'status_label' => $this->status_label,
            'parent' => $this->whenLoaded('parent'), // Eager load parent if available
            'children' => $this->whenLoaded('children'), // Eager load children if available
            'children_count' => $this->whenLoaded('children_count'), // Eager load children count if available
            'is_active' => $this->is_active,
            'code' => $this->code,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
