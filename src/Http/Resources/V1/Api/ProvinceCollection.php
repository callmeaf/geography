<?php

namespace Callmeaf\Geography\Http\Resources\V1\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProvinceCollection extends ResourceCollection
{
    public function __construct($resource,protected array|int $only = [])
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(fn($province) => toArrayResource(data: [
                'id' => fn() => $province->id,
                'status' => fn() => $province->status,
                'status_text' => fn() => $province->statusText,
                'type' => fn() => $province->type,
                'type_text' => fn() => $province->typeText,
                'country_id' => fn() => $province->country_id,
                'parent_id' => fn() => $province->parent_id,
                'name' => fn() => $province->name,
                'slug' => fn() => $province->slug,
                'created_at' => fn() => $province->created_at,
                'created_at_text' => fn() => $province->createdAtText,
                'updated_at' => fn() => $province->updated_at,
                'updated_at_text' => fn() => $province->updatedAtText,
                'country' => fn() => $province->country ? new (config('callmeaf-country.model_resource'))($province->country,only: $this->only['!country'] ?? []) : null,
                // province - state
                'parent' => fn() => $province->parent ? new (config('callmeaf-province.model_resource'))($province->parent,only: $this->only['!parent'] ?? []) : null,
                // province - cities
                'children' => fn() => $province->children?->count() ? new (config('callmeaf-country.model_resource_collection'))($province->children,only: $this->only['!children'] ?? []) : null,
            ],only: $this->only)),
        ];
    }
}
