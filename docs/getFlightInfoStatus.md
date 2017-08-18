# getFlightInfoStatus

Get information about flights for a specific aircraft.

## Request

```php
FlightXML::getFlightInfoStatus($ident, [
    'include_ex_data' => 0,
    'filter' => '',
    'howMany' => 15,
    'offset' => 0,
]);
```

## Response

```php
[
    // Other flights...
    [
        "ident" => "TRA367",
        "faFlightID" => "TRA367-1502459981-adhoc-0",
        "airline" => "TRA",
        "flightnumber" => "367",
        "tailnumber" => "PH-HXJ",
        "type" => "Form_Airline",
        "blocked" => false,
        "diverted" => false,
        "cancelled" => false,
        "origin" => [
            "code" => "EHGG",
            "city" => "Eelde",
            "alternate_ident" => "GRQ",
            "airport_name" => "Groningen Eelde",
        ],
        "destination" => [
            "code" => "EHRD",
            "city" => "Rotterdam",
            "alternate_ident" => "RTM",
            "airport_name" => "Rotterdam",
        ],
        "filed_airspeed_mach" => 0,
        "distance_filed" => 121,
        "filed_departure_time" => [
            "epoch" => 1502459981,
            "tz" => "CEST",
            "dow" => "Friday",
            "time" => "03:59PM",
            "date" => "08/11/2017",
            "localtime" => 1502467181,
        ],
        "estimated_departure_time" => [
            "epoch" => 1502459981,
            "tz" => "CEST",
            "dow" => "Friday",
            "time" => "03:59PM",
            "date" => "08/11/2017",
            "localtime" => 1502467181,
        ],
        "actual_departure_time" => [
            "epoch" => 1502459981,
            "tz" => "CEST",
            "dow" => "Friday",
            "time" => "03:59PM",
            "date" => "08/11/2017",
            "localtime" => 1502467181,
        ],
        "departure_delay" => 0,
        "filed_arrival_time" => [
            "epoch" => 0,
        ],
        "estimated_arrival_time" => [
            "epoch" => 1502461719,
            "tz" => "CEST",
            "dow" => "Friday",
            "time" => "04:28PM",
            "date" => "08/11/2017",
            "localtime" => 1502468919,
        ],
        "actual_arrival_time" => [
            "epoch" => 1502461719,
            "tz" => "CEST",
            "dow" => "Friday",
            "time" => "04:28PM",
            "date" => "08/11/2017",
            "localtime" => 1502468919,
        ],
        "status" => "Arrived",
        "progress_percent" => 100,
        "adhoc" => false,
    ],
    // Other flights...
]
```

## API reference

[https://flightaware.com/commercial/flightxml/v3/apiref.rvt#op_FlightInfoStatus](https://flightaware.com/commercial/flightxml/v3/apiref.rvt#op_FlightInfoStatus)
