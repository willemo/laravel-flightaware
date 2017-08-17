<?php

namespace Willemo\LaravelFlightAware;

use Symfony\Component\OptionsResolver\OptionsResolver;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class FlightXMLClient
{
    /**
     * The client config.
     *
     * @var array
     */
    protected $config;

    /**
     * The HTTP client.
     *
     * @var Client
     */
    protected $client;

    /**
     * Instantiate the FlightXMLClient with its contig.
     *
     * @param array $config The client config array
     */
    public function __construct(array $config = [])
    {
        $resolver = new OptionsResolver;

        $this->configureConfig($resolver);

        $this->config = $resolver->resolve($config);
    }

    /**
     * Get the configured HTTP client.
     *
     * @return Client
     */
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

    /**
     * Get information about flights for a specific aircraft.
     *
     * @param  string $ident   The aircraft identifier
     * @param  array  $options The optional query parameters
     * @return array           All information about flights for the given aircraft
     *
     * @see https://flightaware.com/commercial/flightxml/v3/apiref.rvt#op_FlightInfoStatus
     */
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

    /**
     * Configures the config array.
     *
     * @param  OptionsResolver $resolver The options resolver instance
     * @return void
     */
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

    /**
     * Make a request to the API.
     *
     * @param  string $endpoint    The endpoint to make the request to
     * @param  array  $queryParams The array with query parameters
     * @param  string $key         The key used in the response from the API
     * @return array               The reponse data from the API
     */
    public function makeRequest($endpoint, $queryParams, $key)
    {
        $response = $this->getClient()->request('GET', $endpoint, [
            'query' => $queryParams,
            'http_errors' => false,
        ]);

        return $this->parseResponse($response, $key);
    }

    /**
     * Parse the response from the API.
     *
     * @param  ResponseInterface $response The response from the API
     * @param  string            $key      The key used in the response from the
     *                                     API
     * @return array                       The reponse data from the API
     */
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
