<?php

namespace TeamTNT\Stripe;

class WebhookTester
{
    /**
     * Default API version
     */
    public $version = "2014-09-08";

    public $endpoint;

    public function setVersion($version)
    {
        $this->version = $version;
    }

    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
    }
}
