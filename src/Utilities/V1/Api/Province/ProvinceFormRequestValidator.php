<?php

namespace Callmeaf\Geography\Utilities\V1\Api\Province;

use Callmeaf\Base\Utilities\V1\FormRequestValidator;

class ProvinceFormRequestValidator extends FormRequestValidator
{
    public function index(): array
    {
        return [
            'country_id' => false,
            'parent_id' => false,
            'status' => false,
            'type' => false,
            'name' => false,
            'slug' => false,
        ];
    }

    public function store(): array
    {
        return [
            'country_id' => true,
            'parent_id' => false,
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
            'country_id' => true,
            'parent_id' => false,
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
