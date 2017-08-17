<?php

namespace Willemo\LaravelFlightAware;

use Illuminate\Support\Facades\Facade;

class FlightXMLFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return FlightXMLClient::class;
    }
}
