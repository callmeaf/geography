<?php

namespace Callmeaf\Geography\Http\Resources\V1\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProvinceResource extends JsonResource
{
    public function __construct($resource,protected array|int $only = [])
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return toArrayResource(data: [
            'id' => fn() => $this->id,
            'status' => fn() => $this->status,
            'status_text' => fn() => $this->statusText,
            'type' => fn() => $this->type,
            'type_text' => fn() => $this->typeText,
            'country_id' => fn() => $this->country_id,
            'parent_id' => fn() => $this->parent_id,
            'name' => fn() => $this->name,
            'slug' => fn() => $this->slug,
            'created_at' => fn() => $this->created_at,
            'created_at_text' => fn() => $this->createdAtText,
            'updated_at' => fn() => $this->updated_at,
            'updated_at_text' => fn() => $this->updatedAtText,
            'country' => fn() => $this->country ? new (config('callmeaf-country.model_resource'))($this->country,only: $this->only['!country'] ?? []) : null,
            // province - state
            'parent' => fn() => $this->parent ? new (config('callmeaf-province.model_resource'))($this->parent,only: $this->only['!parent'] ?? []) : null,
            // province - cities
            'children' => fn() => $this->children?->count() ? new (config('callmeaf-country.model_resource_collection'))($this->children,only: $this->only['!children'] ?? []) : null,
        ],only: $this->only);
    }
}
