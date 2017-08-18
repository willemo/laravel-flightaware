# getAirportInfo

Get information about an airport given an airport code.

## Request

```php
FlightXML::getAirportInfo($airportCode);
```

## Response

```php
[
    "airport_code" => "EHGG",
    "name" => "Groningen Eelde",
    "elevation" => 17.0,
    "city" => "Eelde",
    "state" => "",
    "longitude" => 6.579444,
    "latitude" => 53.11972,
    "timezone" => ":Europe/Amsterdam",
    "country_code" => "NL",
    "wiki_url" => "http://en.wikipedia.org/wiki/Groningen_Airport_Eelde",
]
```

## API reference

[https://flightaware.com/commercial/flightxml/v3/apiref.rvt#op_AirportInfo](https://flightaware.com/commercial/flightxml/v3/apiref.rvt#op_AirportInfo)
