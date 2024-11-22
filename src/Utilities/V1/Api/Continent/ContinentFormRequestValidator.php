<?php

namespace Callmeaf\Geography\Utilities\V1\Api\Continent;

use Callmeaf\Base\Utilities\V1\FormRequestValidator;

class ContinentFormRequestValidator extends FormRequestValidator
{
    public function index(): array
    {
        return [
            'name' => false,
            'slug' => false,
        ];
    }

    public function store(): array
    {
        return [
            'status' => true,
            'type' => false,
            'name' => true,
            'slug' => true,
        ];
    }

    public function show(): array
    {
        return [];
    }

    public function update(): array
    {
        return [
            'status' => true,
            'type' => false,
            'name' => true,
            'slug' => true,
        ];
    }

    public function statusUpdate(): array
    {
        return [
            'status' => true,
        ];
    }

    public function destroy(): array
    {
        return [];
    }
}
