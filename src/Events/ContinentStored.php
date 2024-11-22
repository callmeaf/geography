<?php

namespace Callmeaf\Geography\Events;

use Callmeaf\Geography\Models\Continent;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ContinentStored
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public Continent $continent)
    {

    }
}
