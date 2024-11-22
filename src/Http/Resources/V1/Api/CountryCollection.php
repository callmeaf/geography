<?php

namespace Callmeaf\Geography\Http\Resources\V1\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CountryCollection extends ResourceCollection
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
            'data' => $this->collection->map(fn($country) => toArrayResource(data: [
                'id' => fn() => $country->id,
                'status' => fn() => $country->status,
                'status_text' => fn() => $country->statusText,
                'type' => fn() => $country->type,
                'type_text' => fn() => $country->typeText,
                'parent_id' => fn() => $country->parent_id,
                'name' => fn() => $country->name,
                'slug' => fn() => $country->slug,
                'created_at' => fn() => $country->created_at,
                'created_at_text' => fn() => $country->createdAtText,
                'updated_at' => fn() => $country->updated_at,
                'updated_at_text' => fn() => $country->updatedAtText,
                // continent
                'parent' => fn() => $country->parent ? new (config('callmeaf-continent.model_resource'))($country->parent,only: $this->only['!parent'] ?? []) : null,
                // provinces
                'children' => fn() => $country->children?->count() ? new (config('callmeaf-country.model_resource_collection'))($country->children,only: $this->only['!children'] ?? []) : null,
            ],only: $this->only)),
        ];
    }
}
