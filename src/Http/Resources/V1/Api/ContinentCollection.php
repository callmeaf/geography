<?php

namespace Callmeaf\Geography\Http\Resources\V1\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ContinentCollection extends ResourceCollection
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
            'data' => $this->collection->map(fn($continent) => toArrayResource(data: [
                'id' => fn() => $continent->id,
                'status' => fn() => $continent->status,
                'status_text' => fn() => $continent->statusText,
                'type' => fn() => $continent->type,
                'type_text' => fn() => $continent->typeText,
                'name' => fn() => $continent->name,
                'slug' => fn() => $continent->slug,
                'created_at' => fn() => $continent->created_at,
                'created_at_text' => fn() => $continent->createdAtText,
                'updated_at' => fn() => $continent->updated_at,
                'updated_at_text' => fn() => $continent->updatedAtText,
            ],only: $this->only)),
        ];
    }
}
