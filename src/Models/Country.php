<?php

namespace Callmeaf\Geography\Models;

use Callmeaf\Base\Casts\Uppercase;
use Callmeaf\Base\Contracts\HasEnum;
use Callmeaf\Base\Contracts\HasResponseTitles;
use Callmeaf\Base\Enums\ResponseTitle;
use Callmeaf\Base\Traits\HasDate;
use Callmeaf\Base\Traits\HasParent;
use Callmeaf\Base\Traits\HasStatus;
use Callmeaf\Base\Traits\HasType;
use Callmeaf\Geography\Enums\CountryStatus;
use Callmeaf\Geography\Enums\CountryType;
use Illuminate\Database\Eloquent\Model;

class Country extends Model implements HasResponseTitles,HasEnum
{
    use HasParent,HasDate,HasStatus,HasType;
    protected $fillable = [
        'parent_id',
        'status',
        'type',
        'code',
        'name',
        'slug',
    ];

    protected $casts = [
        'status' => CountryStatus::class,
        'type' => CountryType::class,
        'code' => Uppercase::class,
    ];

    public function parentModel(): string
    {
        return Continent::class;
    }

    public function responseTitles(ResponseTitle|string $key,string $default = ''): string
    {
        return [
            'store' => $this->name ?? $default,
            'update' => $this->name ?? $default,
            'status_update' => $this->name ?? $default,
            'destroy' => $this->name ?? $default,
        ][$key instanceof ResponseTitle ? $key->value : $key];
    }

    public static function enumsLang(): array
    {
        return __('callmeaf-geography::enums');
    }
}
