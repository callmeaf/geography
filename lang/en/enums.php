<?php

use Callmeaf\Geography\Enums\ContinentStatus;
use Callmeaf\Geography\Enums\ContinentType;
use Callmeaf\Geography\Enums\CountryStatus;
use Callmeaf\Geography\Enums\CountryType;
use Callmeaf\Geography\Enums\ProvinceStatus;
use Callmeaf\Geography\Enums\ProvinceType;

return [
    ContinentStatus::class => [
        ContinentStatus::ACTIVE->name => 'Active',
        ContinentStatus::INACTIVE->name => 'InActive',
    ],
    ContinentType::class => [
        ContinentType::BIG->name => 'Big',
        ContinentType::SMALL->name => 'Small',
    ],
    CountryStatus::class => [
        CountryStatus::ACTIVE->name => 'Active',
        CountryStatus::INACTIVE->name => 'InActive',
    ],
    CountryType::class => [
        CountryType::REPUBLICAN->name => 'Republican',
        CountryType::DEMOCRAT->name => 'Democrat',
        CountryType::DICTATOR->name => 'Dictator',
    ],
    ProvinceStatus::class => [
        ProvinceStatus::ACTIVE->name => 'Active',
        ProvinceStatus::INACTIVE->name => 'InActive',
    ],
    ProvinceType::class => [
        ProvinceType::HIGH_POPULATION->name => 'High Population',
        ProvinceType::LOW_POPULATION->name => 'Low Population',
    ],
];
