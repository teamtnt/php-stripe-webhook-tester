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
        $file = './src/webhooks/'.$this->version.'/'.$name.'.json';

        if (!file_exists($file)) {
            throw new InvalidEventException("Event does not exist in version " . $this->version, 1);
        }

        return file_get_contents($file);
    }

}
