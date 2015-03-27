<?php 

use TeamTNT\Stripe\WebhookTester;

class WebhookTesterTest extends \PHPUnit_Framework_TestCase
{
    public function testDefaultVersion()
    {
        $tester = new WebhookTester;
        $this->assertEquals('2014-09-08', $tester->version);
    }

    public function testSetEndpoint()
    {
        $tester = new WebhookTester;
        $this->assertEquals(null, $tester->endpoint);

        $tester->setEndpoint('http://localhost');
        $this->assertEquals('http://localhost', $tester->endpoint);
    }
}