<?php

declare(strict_types=1);

namespace Uc\EventHub\Tests\Unit;

use Tests\TestCase;
use Illuminate\Events\Dispatcher;
use Uc\EventHub\Client;
use Uc\KafkaProducer\MessageBuilder;

class ClientTest extends TestCase
{


    public const EVENT = 'SOME_EVENT';

    /**
     * @return void
     */
    public function testSend_WithGivenProperties_ReturnAssertNull() : void
    {
        $client = $this->createClient();
        $this->assertNull($client->send(new Payload, $this::EVENT));
    }


    /**
     * @return \Uc\KafkaProducer\MessageBuilder
     */
    protected function messageBuilder() : MessageBuilder
    {
        return new MessageBuilder();
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockDispatcher(): \PHPUnit\Framework\MockObject\MockObject
    {
        $mock = $this->getMockBuilder(Dispatcher::class)->getMock();
        $mock->method('dispatch')->willReturn([]);
        return $mock;
    }

    /**
     * @return \Uc\EventHub\Client
     */
    protected function createClient() : Client
    {
        return new Client($this->mockDispatcher(), $this->messageBuilder());
    }
}
