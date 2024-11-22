<?php

namespace Callmeaf\Geography\Utilities\V1\Api\Country;

use Callmeaf\Base\Utilities\V1\FormRequestAuthorizer;
use Callmeaf\Permission\Enums\PermissionName;

class CountryFormRequestAuthorizer extends FormRequestAuthorizer
{
    public function index(): bool
    {
        return userCan(PermissionName::COUNTRY_INDEX);
    }

    public function create(): bool
    {
        return userCan(PermissionName::COUNTRY_STORE);
    }

    public function store(): bool
    {
        return userCan(PermissionName::COUNTRY_STORE);
    }

    public function show(): bool
    {
        return userCan(PermissionName::COUNTRY_SHOW);
    }

    public function edit(): bool
    {
        return userCan(PermissionName::COUNTRY_UPDATE);
    }

    public function update(): bool
    {
        return userCan(PermissionName::COUNTRY_UPDATE);
    }

    public function statusUpdate(): bool
    {
        return userCan(PermissionName::COUNTRY_UPDATE);
    }

    public function destroy(): bool
    {
        return userCan(PermissionName::COUNTRY_DESTROY);
    }
}
