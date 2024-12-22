<?php

namespace Callmeaf\Geography\Models;

use Callmeaf\Base\Casts\Uppercase;
use Callmeaf\Base\Contracts\HasEnum;
use Callmeaf\Base\Contracts\HasResponseTitles;
use Callmeaf\Base\Enums\ResponseTitle;
use Callmeaf\Base\Traits\HasChildren;
use Callmeaf\Base\Traits\HasDate;
use Callmeaf\Base\Traits\HasParent;
use Callmeaf\Base\Traits\HasStatus;
use Callmeaf\Base\Traits\HasType;
use Callmeaf\Base\Traits\Sluggable;
use Callmeaf\Geography\Enums\ProvinceStatus;
use Callmeaf\Geography\Enums\ProvinceType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Province extends Model implements HasResponseTitles,HasEnum
{
    use HasParent,HasChildren,HasDate,HasStatus,HasType,Sluggable;
    protected $fillable = [
        'parent_id',
        'status',
        'type',
        'code',
        'name',
        'slug',
    ];

    protected $casts = [
        'status' => ProvinceStatus::class,
        'type' => ProvinceType::class,
        'code' => Uppercase::class,
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(config('callmeaf-country.model'));
    }

    public function parentModel(): string
    {
        return self::class;
    }

    public function childrenModel(): string
    {
        return self::class;
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
