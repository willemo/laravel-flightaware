# Laravel FlightAware

Laravel service provider for the FlightAware FlightXML V3 API.

## Installation

You can download this package with Composer:

```
composer.phar require willemo/laravel-flightaware
```

After Composer is done downloading the package you'll have to add the service provider and facade to your `config/app.php` file:

```php
return [

    // Other config
    
    'providers' => [
        // Other providers
        Willemo\LaravelFlightAware\FlightXMLServiceProvider::class,
    ],

    'aliases' => [
        // Other aliases
        'FlightXML' => Willemo\LaravelFlightAware\FlightXMLFacade::class,
    ],

];
```

After this you'll have to run the command below to publish the config file:

```
php artisan vendor:publish --provider="Willemo\LaravelFlightAware\FlightXMLServiceProvider"
```

## Configuration

You can configure the package in the `config/flightxml.php` file. You'll have to add your username and API key from FlightAware to your environment with the following keys:

- `FLIGHTXML_USERNAME`
- `FLIGHTXML_API_KEY`

## Usage

You can use the `FlightXML` facade to make calls to the FlightAware API. Right now the endpoints listed below are supported. The methods use the same arguments as the API reference lists. For more information about the endpoints, see the files in the `docs` folder.

- `FlightXML::getAirportInfo($airportCode);`
- `FlightXML::getFlightInfoStatus($ident, $options = []);`

## Note

Copyright of the name FlightAware, FlightXML and its API belong to FlightAware.
