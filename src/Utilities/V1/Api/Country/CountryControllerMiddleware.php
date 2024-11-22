<?php

namespace Callmeaf\Geography\Utilities\V1\Api\Country;

use Callmeaf\Base\Http\Controllers\BaseController;
use Callmeaf\Base\Utilities\V1\ControllerMiddleware;


class CountryControllerMiddleware extends ControllerMiddleware
{
    public function __invoke(BaseController $controller): void
    {
        $controller->middleware('auth:sanctum')->only([
            'index',
            'store',
            'show',
            'update',
            'statusUpdate',
            'destroy',
        ]);
    }
}