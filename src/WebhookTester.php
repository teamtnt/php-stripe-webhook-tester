<?php

namespace TeamTNT\Stripe;

class WebhookTester
{
    /**
     * Default API version
     */
    public $version = "2014-09-08";

    public function setVersion($value)
    {
        $this->version = $value;
    }
}
