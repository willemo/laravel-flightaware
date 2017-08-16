<?php

namespace Willemo\LaravelFlightAware;

use Symfony\Component\OptionsResolver\OptionsResolver;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class FlightXMLClient
{
    protected $config;

    protected $client;

    public function __construct(array $config = [])
    {
        $resolver = new OptionsResolver;

        $this->configureConfig($resolver);

        $this->config = $resolver->resolve($config);
    }

    public function getClient()
    {
        if ($this->client === null) {
            $this->client = new Client([
                'base_uri' => $this->config['base_uri'],
                'auth' => [
                    $this->config['username'],
                    $this->config['api_key'],
                ],
            ]);
        }

        return $this->client;
    }

    public function getFlightInfoStatus($ident, array $options = [])
    {
        $options['ident'] = $ident;

        $resolver = new OptionsResolver;

        $resolver->setRequired('ident');

        $resolver->setDefined([
            'include_ex_data',
            'filter',
            'howMany',
            'offset',
        ]);

        $queryParams = $resolver->resolve($options);

        return $this->makeRequest('FlightInfoStatus', $queryParams, 'flights');
    }

    protected function configureConfig(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'base_uri' => 'http://flightxml.flightaware.com/json/FlightXML3/',
        ]);

        $resolver->setRequired([
            'username',
            'api_key',
        ]);
    }

    protected function makeRequest($endpoint, $queryParams, $key)
    {
        $response = $this->getClient()->request('GET', $endpoint, [
            'query' => $queryParams,
        ]);

        return $this->parseResponse($response, $key);
    }

    protected function parseResponse(ResponseInterface $response, $key)
    {
        $body = json_decode($response->getBody(), true);

        if ($response->getStatusCode() != 200 ||
            array_key_exists('error', $body)
        ) {
            throw new \Exception($body['error']);
        }

        reset($body);

        $firstKey = key($body);

        $data = $body[$firstKey][$key];

        return $data;
    }
}
