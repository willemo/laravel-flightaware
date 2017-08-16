<?php

namespace Willemo\LaravelFlightAware;

use Symfony\Component\OptionsResolver\OptionsResolver;

class FlightXMLClient
{
    protected $config;

    public function __construct(array $config = [])
    {
        $resolver = new OptionsResolver;

        $this->configureOptions($resolver);

        $this->config = $resolver->resolve($config);
    }

    protected function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'base_uri' => 'http://flightxml.flightaware.com/json/FlightXML3/',
        ]);

        $resolver->setRequired([
            'username',
            'api_key',
        ]);
    }
}
