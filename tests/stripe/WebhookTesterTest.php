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
        $tester = new TeamTNT\Stripe\WebhookTester();
        $tester->setVersion('2014-09-08');
        $tester->setEndpoint('http://httpbin.org/post');

        $response = $tester->triggerEvent('charge.succeeded');

        $this->assertEquals(200, $response->getStatusCode());
    }
}