<?php

namespace Callmeaf\Geography\Utilities\V1\Api\Province;

use Callmeaf\Base\Utilities\V1\FormRequestAuthorizer;
use Callmeaf\Permission\Enums\PermissionName;

class ProvinceFormRequestAuthorizer extends FormRequestAuthorizer
{
    public function index(): bool
    {
        return userCan(PermissionName::PROVINCE_INDEX);
    }

    public function create(): bool
    {
        return userCan(PermissionName::PROVINCE_STORE);
    }

    public function store(): bool
    {
        return userCan(PermissionName::PROVINCE_STORE);
    }

    public function show(): bool
    {
        return userCan(PermissionName::PROVINCE_SHOW);
    }

    public function edit(): bool
    {
        return userCan(PermissionName::PROVINCE_UPDATE);
    }

    public function update(): bool
    {
        return userCan(PermissionName::PROVINCE_UPDATE);
    }

    public function statusUpdate(): bool
    {
        return userCan(PermissionName::PROVINCE_UPDATE);
    }

    public function destroy(): bool
    {
        return userCan(PermissionName::PROVINCE_DESTROY);
    }
}
