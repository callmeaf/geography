<?php

namespace Callmeaf\Geography\Events;

use Callmeaf\Geography\Models\Country;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CountryShowed
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public Country $country)
    {

    }
}
