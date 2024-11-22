<?php

use Callmeaf\Geography\Enums\ContinentStatus;
use Callmeaf\Geography\Enums\ContinentType;
use Callmeaf\Geography\Enums\CountryStatus;
use Callmeaf\Geography\Enums\CountryType;
use Callmeaf\Geography\Enums\ProvinceStatus;
use Callmeaf\Geography\Enums\ProvinceType;

return [
    ContinentStatus::class => [
        ContinentStatus::ACTIVE->name => 'فعال',
        ContinentStatus::INACTIVE->name => 'غیر فعال',
    ],
    ContinentType::class => [
        ContinentType::BIG->name => 'بزرگ',
        ContinentType::SMALL->name => 'کوچک',
    ],
    CountryStatus::class => [
        CountryStatus::ACTIVE->name => 'فعال',
        CountryStatus::INACTIVE->name => 'غیر فعال',
    ],
    CountryType::class => [
        CountryType::REPUBLICAN->name => 'جمهوری خواه',
        CountryType::DEMOCRAT->name => 'دموکرات',
        CountryType::DICTATOR->name => 'دیکتاتور',
    ],
    ProvinceStatus::class => [
        ProvinceStatus::ACTIVE->name => 'فعال',
        ProvinceStatus::INACTIVE->name => 'غیر فعال',
    ],
    ProvinceType::class => [
        ProvinceType::HIGH_POPULATION->name => 'پر چمعیت',
        ProvinceType::LOW_POPULATION->name => 'کم جمعیت',
    ],
];
