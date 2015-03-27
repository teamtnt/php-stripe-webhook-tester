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

    public function testLoadJson()
    {
        $tester = new WebhookTester;
        $actual = $tester->loadEventData('charge.succeeded');
        $expected = file_get_contents('./src/webhooks/2014-09-08/charge.succeeded.json');
        $this->assertJsonStringEqualsJsonString($expected, $actual);
    }
}