<?php

namespace Callmeaf\Geography\Services\V1;

use Callmeaf\Base\Services\V1\BaseService;
use Callmeaf\Geography\Services\V1\Contracts\ContinentServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ContinentService extends BaseService implements ContinentServiceInterface
{
    public function __construct(?Builder $query = null, ?Model $model = null, ?Collection $collection = null, ?JsonResource $resource = null, ?ResourceCollection $resourceCollection = null, array $defaultData = [],?string $searcher = null)
    {
        parent::__construct($query, $model, $collection, $resource, $resourceCollection, $defaultData,$searcher);
        $this->query = app(config('callmeaf-continent.model'))->query();
        $this->resource = config('callmeaf-continent.model_resource');
        $this->resourceCollection = config('callmeaf-continent.model_resource_collection');
        $this->defaultData = config('callmeaf-continent.default_values');
        $this->searcher = config('callmeaf-continent.searcher');
    }
}
