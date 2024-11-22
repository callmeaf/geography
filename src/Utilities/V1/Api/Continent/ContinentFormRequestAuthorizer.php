<?php

namespace Callmeaf\Geography\Utilities\V1\Api\Continent;

use Callmeaf\Base\Utilities\V1\FormRequestAuthorizer;
use Callmeaf\Permission\Enums\PermissionName;

class ContinentFormRequestAuthorizer extends FormRequestAuthorizer
{
    public function index(): bool
    {
        return userCan(PermissionName::CONTINENT_INDEX);
    }

    public function create(): bool
    {
        return userCan(PermissionName::CONTINENT_STORE);
    }

    public function store(): bool
    {
        return userCan(PermissionName::CONTINENT_STORE);
    }

    public function show(): bool
    {
        return userCan(PermissionName::CONTINENT_SHOW);
    }

    public function edit(): bool
    {
        return userCan(PermissionName::CONTINENT_UPDATE);
    }

    public function update(): bool
    {
        return userCan(PermissionName::CONTINENT_UPDATE);
    }

    public function statusUpdate(): bool
    {
        return userCan(PermissionName::CONTINENT_UPDATE);
    }

    public function destroy(): bool
    {
        return userCan(PermissionName::CONTINENT_DESTROY);
    }
}
