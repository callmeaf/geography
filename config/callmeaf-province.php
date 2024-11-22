<?php

return [
    'model' => \Callmeaf\Geography\Models\Province::class,
    'model_resource' => \Callmeaf\Geography\Http\Resources\V1\Api\ProvinceResource::class,
    'model_resource_collection' => \Callmeaf\Geography\Http\Resources\V1\Api\ProvinceCollection::class,
    'service' => \Callmeaf\Geography\Services\V1\ProvinceService::class,
    'default_values' => [
        'status' => \Callmeaf\Geography\Enums\ProvinceStatus::ACTIVE,
    ],
    'events' => [
        \Callmeaf\Geography\Events\ProvinceIndexed::class => [
            // listeners
        ],
        \Callmeaf\Geography\Events\ProvinceStored::class => [
            // listeners
        ],
        \Callmeaf\Geography\Events\ProvinceShowed::class => [
            // listeners
        ],
        \Callmeaf\Geography\Events\ProvinceUpdated::class => [
            // listeners
        ],
        \Callmeaf\Geography\Events\ProvinceStatusUpdated::class => [
            // listeners
        ],
        \Callmeaf\Geography\Events\ProvinceDestroyed::class => [
            // listeners
        ],
    ],
    'validations' => [
        'province' => \Callmeaf\Geography\Utilities\V1\Api\Province\ProvinceFormRequestValidator::class,
    ],
    'resources' => [
        'province' => \Callmeaf\Geography\Utilities\V1\Api\Province\ProvinceResources::class,
    ],
    'controllers' => [
        'provinces' => \Callmeaf\Geography\Http\Controllers\V1\Api\ProvinceController::class,
    ],
    'form_request_authorizers' => [
        'province' => \Callmeaf\Geography\Utilities\V1\Api\Province\ProvinceFormRequestAuthorizer::class,
    ],
    'middlewares' => [
        'province' => \Callmeaf\Geography\Utilities\V1\Api\Province\ProvinceControllerMiddleware::class,
    ],
    'searcher' => \Callmeaf\Geography\Utilities\V1\Api\Province\ProvinceSearcher::class,
];
