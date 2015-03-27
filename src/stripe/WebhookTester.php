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

    public function loadEventData($name)
    {
       return file_get_contents('./src/webhooks/'.$this->version.'/charge.succeeded.json');
    }

}
