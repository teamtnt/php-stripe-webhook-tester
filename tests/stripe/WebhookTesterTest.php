<?php 

use TeamTNT\Stripe\WebhookTester;
use GuzzleHttp\Client;
use GuzzleHttp\Subscriber\Mock;
use GuzzleHttp\Message\Response;

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

    public function testLoadEventData()
    {
        $tester = new WebhookTester;
        $actual = $tester->loadEventData('charge.succeeded');
        $expected = file_get_contents('./src/webhooks/2014-09-08/charge.succeeded.json');
        $this->assertJsonStringEqualsJsonString($expected, $actual);
    }

    /**
     * @expectedException        TeamTNT\Stripe\InvalidEventException
     * @expectedExceptionMessage Event does not exist in version 2014-09-08
     */
    public function testNonExistentEvent()
    {
        $tester = new WebhookTester;
        $actual = $tester->loadEventData('does.not.exist');
    }

    /**
     * @expectedException        TeamTNT\Stripe\InvalidEventException
     * @expectedExceptionMessage Event name required
     */
    public function testEmptyEventName()
    {
        $tester = new WebhookTester;
        $actual = $tester->triggerEvent();
    }

    public function testTriggerEvent()
    {
        $mock = new Mock([
            new Response(200, []),         // Use response object
            "HTTP/1.1 202 OK\r\nContent-Length: 0\r\n\r\n"  // Use a response string
        ]);
        $tester = new WebhookTester();
        $client = $tester->getClient()->getEmitter()->attach($mock);

        $tester->setVersion('2014-09-08');
        $tester->setEndpoint('http://localhost/stripe/webhooks');

        $response = $tester->triggerEvent('charge.succeeded');

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testEndpointThroughContstructor()
    {
        $mock = new Mock([
            new Response(200, []),         // Use response object
            "HTTP/1.1 202 OK\r\nContent-Length: 0\r\n\r\n"  // Use a response string
        ]);
        $tester = new WebhookTester('http://localhost/stripe/webhooks');
        $client = $tester->getClient()->getEmitter()->attach($mock);
        $response = $tester->triggerEvent('charge.succeeded');

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testChaining()
    {
        $mock = new Mock([
            new Response(200, []),         // Use response object
            "HTTP/1.1 202 OK\r\nContent-Length: 0\r\n\r\n"  // Use a response string
        ]);
        $tester = new WebhookTester();
        $client = $tester->getClient()->getEmitter()->attach($mock);

        $response = $tester->setEndpoint('http://localhost/stripe/webhooks')
                           ->setVersion('2014-09-08')
                           ->triggerEvent('charge.succeeded');

        $this->assertEquals(200, $response->getStatusCode());                  
    }
}