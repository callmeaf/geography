<?php

namespace Callmeaf\Geography\Events;

use Callmeaf\Geography\Models\Country;
use Callmeaf\Geography\Models\Province;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProvinceDestroyed
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public Province $province)
    {

    }
}
