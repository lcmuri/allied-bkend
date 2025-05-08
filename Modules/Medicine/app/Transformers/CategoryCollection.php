<?php

namespace Modules\Medicine\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => CategoryResource::collection($this->collection),
            // 'meta' => [
            //     'total' => $this->collection->count(),
            //     // 'per_page' => 15, // Adjust based on your pagination
            //     // 'current_page' => $this->currentPage(),
            //     // 'last_page' => $this->lastPage(),
            // ],
        ];
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @return array<string, mixed>
     */
    public function with(Request $request): array
    {
        return [
            'total' => $this->collection->count(),
            'status' => 'success',
            'message' => 'Categories retrieved successfully',
        ];
    }
}
