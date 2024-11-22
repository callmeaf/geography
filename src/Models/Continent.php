<?php

namespace Callmeaf\Geography\Models;

use Callmeaf\Base\Contracts\HasEnum;
use Callmeaf\Base\Contracts\HasResponseTitles;
use Callmeaf\Base\Enums\ResponseTitle;
use Callmeaf\Base\Traits\HasChildren;
use Callmeaf\Base\Traits\HasDate;
use Callmeaf\Base\Traits\HasStatus;
use Callmeaf\Base\Traits\HasType;
use Callmeaf\Geography\Enums\ContinentStatus;
use Callmeaf\Geography\Enums\ContinentType;
use Illuminate\Database\Eloquent\Model;

class Continent extends Model implements HasResponseTitles,HasEnum
{
    use HasChildren,HasDate,HasStatus,HasType;
    protected $fillable = [
        'status',
        'type',
        'name',
        'slug',
    ];

    protected $casts = [
        'status' => ContinentStatus::class,
        'type' => ContinentType::class,
    ];

    public function childrenModel(): string
    {
        return Country::class;
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
