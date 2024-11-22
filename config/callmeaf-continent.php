<?php

return [
    'model' => \Callmeaf\Geography\Models\Continent::class,
    'model_resource' => \Callmeaf\Geography\Http\Resources\V1\Api\ContinentResource::class,
    'model_resource_collection' => \Callmeaf\Geography\Http\Resources\V1\Api\ContinentCollection::class,
    'service' => \Callmeaf\Geography\Services\V1\ContinentService::class,
    'default_values' => [
        'status' => \Callmeaf\Geography\Enums\ContinentStatus::ACTIVE,
    ],
    'events' => [
        \Callmeaf\Geography\Events\ContinentIndexed::class => [
            // listeners
        ],
        \Callmeaf\Geography\Events\ContinentStored::class => [
            // listeners
        ],
        \Callmeaf\Geography\Events\ContinentShowed::class => [
            // listeners
        ],
        \Callmeaf\Geography\Events\ContinentUpdated::class => [
            // listeners
        ],
        \Callmeaf\Geography\Events\ContinentStatusUpdated::class => [
            // listeners
        ],
        \Callmeaf\Geography\Events\ContinentDestroyed::class => [
            // listeners
        ],
    ],
    'validations' => [
        'continent' => \Callmeaf\Geography\Utilities\V1\Api\Continent\ContinentFormRequestValidator::class,
    ],
    'resources' => [
        'continent' => \Callmeaf\Geography\Utilities\V1\Api\Continent\ContinentResources::class,
    ],
    'controllers' => [
        'continents' => \Callmeaf\Geography\Http\Controllers\V1\Api\ContinentController::class,
    ],
    'form_request_authorizers' => [
        'continent' => \Callmeaf\Geography\Utilities\V1\Api\Continent\ContinentFormRequestAuthorizer::class,
    ],
    'middlewares' => [
        'continent' => \Callmeaf\Geography\Utilities\V1\Api\Continent\ContinentControllerMiddleware::class,
    ],
    'searcher' => \Callmeaf\Geography\Utilities\V1\Api\Continent\ContinentSearcher::class,
];
