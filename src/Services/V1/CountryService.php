<?php

namespace Callmeaf\Geography\Services\V1;

use Callmeaf\Base\Services\V1\BaseService;
use Callmeaf\Geography\Services\V1\Contracts\CountryServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CountryService extends BaseService implements CountryServiceInterface
{
    public function __construct(?Builder $query = null, ?Model $model = null, ?Collection $collection = null, ?JsonResource $resource = null, ?ResourceCollection $resourceCollection = null, array $defaultData = [],?string $searcher = null)
    {
        parent::__construct($query, $model, $collection, $resource, $resourceCollection, $defaultData,$searcher);
        $this->query = app(config('callmeaf-country.model'))->query();
        $this->resource = config('callmeaf-country.model_resource');
        $this->resourceCollection = config('callmeaf-country.model_resource_collection');
        $this->defaultData = config('callmeaf-country.default_values');
        $this->searcher = config('callmeaf-country.searcher');
    }
}
