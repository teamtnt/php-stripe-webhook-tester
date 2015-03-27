<?php

namespace TeamTNT\Stripe;

use GuzzleHttp\Client;

class WebhookTester
{
    /**
     * Default API version
     */
    public $version = "2014-09-08";

    public $endpoint;


    /**
     * @var Client
     */
    private $client;

    public function __construct($endpoint = null) {
        if ($endpoint) {
            $this->endpoint = $endpoint;
        }
        $this->client = new Client();
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param mixed $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    public function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }

    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
        return $this;
    }

    public function loadEventData($name)
    {
        $file = dirname(__FILE__) . '/../webhooks/'.$this->version.'/'.$name.'.json';

        if (!file_exists($file)) {
            throw new InvalidEventException("Event does not exist in version ".$this->version, 1);
        }

        return file_get_contents($file);
    }


    /**
     * Triggers a simulated Stripe web hook event
     *
     * @param null|string $event
     * @return \GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface|null
     * @throws InvalidEventException
     */
    public function triggerEvent($event = null)
    {

        if (is_null($event)) {
            throw new InvalidEventException("Event name required");
        }

        $response = $this->client->post($this->endpoint, [
            'headers' => ['content-type' => 'application/json'],
            'body' => $this->loadEventData($event)
        ]);

        return $response;
    }

}
