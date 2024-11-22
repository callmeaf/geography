<?php

return [
    'model' => \Callmeaf\Geography\Models\Country::class,
    'model_resource' => \Callmeaf\Geography\Http\Resources\V1\Api\CountryResource::class,
    'model_resource_collection' => \Callmeaf\Geography\Http\Resources\V1\Api\CountryCollection::class,
    'service' => \Callmeaf\Geography\Services\V1\CountryService::class,
    'default_values' => [
        'status' => \Callmeaf\Geography\Enums\CountryStatus::ACTIVE,
    ],
    'events' => [
        \Callmeaf\Geography\Events\CountryIndexed::class => [
            // listeners
        ],
        \Callmeaf\Geography\Events\CountryStored::class => [
            // listeners
        ],
        \Callmeaf\Geography\Events\CountryShowed::class => [
            // listeners
        ],
        \Callmeaf\Geography\Events\CountryUpdated::class => [
            // listeners
        ],
        \Callmeaf\Geography\Events\CountryStatusUpdated::class => [
            // listeners
        ],
        \Callmeaf\Geography\Events\CountryDestroyed::class => [
            // listeners
        ],
    ],
    'validations' => [
        'country' => \Callmeaf\Geography\Utilities\V1\Api\Country\CountryFormRequestValidator::class,
    ],
    'resources' => [
        'country' => \Callmeaf\Geography\Utilities\V1\Api\Country\CountryResources::class,
    ],
    'controllers' => [
        'countries' => \Callmeaf\Geography\Http\Controllers\V1\Api\CountryController::class,
    ],
    'form_request_authorizers' => [
        'country' => \Callmeaf\Geography\Utilities\V1\Api\Country\CountryFormRequestAuthorizer::class,
    ],
    'middlewares' => [
        'country' => \Callmeaf\Geography\Utilities\V1\Api\Country\CountryControllerMiddleware::class,
    ],
    'searcher' => \Callmeaf\Geography\Utilities\V1\Api\Country\CountrySearcher::class,
];
