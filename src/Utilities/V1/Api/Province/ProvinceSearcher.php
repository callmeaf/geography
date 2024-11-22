<?php

namespace Callmeaf\Geography\Utilities\V1\Api\Province;

use Callmeaf\Base\Utilities\V1\Contracts\SearcherInterface;
use Illuminate\Database\Eloquent\Builder;

class ProvinceSearcher implements SearcherInterface
{
    public function apply(Builder $query, array $filters = []): void
    {
        $filters = collect($filters)->filter(fn($item) => strlen(trim($item)));
        if($value = $filters->get('country_id')) {
            $query->where('country_id',$value);
        }
        if($value = $filters->get('name')) {
            $query->where('name','like',searcherLikeValue($value));
        }
        if($value = $filters->get('slug')) {
            $query->where('slug','like',searcherLikeValue($value));
        }
    }
}
