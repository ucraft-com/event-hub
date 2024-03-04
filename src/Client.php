<?php

declare(strict_types=1);

namespace Uc\EventHub;

use Illuminate\Events\Dispatcher;
use Uc\KafkaProducer\Events\ProduceMessageEvent;
use Uc\KafkaProducer\MessageBuilder;
use Uc\EventHub\Contracts\EventPayload;

class Client
{
    /**
     * @var \Uc\KafkaProducer\MessageBuilder
     */
    private MessageBuilder $builder;

    /**
     * @var Dispatcher
     */
    private Dispatcher $dispatcher;

    /**
     * @param \Illuminate\Events\Dispatcher    $dispatcher
     * @param \Uc\KafkaProducer\MessageBuilder $builder
     */
    public function __construct(
        Dispatcher $dispatcher,
        MessageBuilder $builder
    ) {
        $this->dispatcher = $dispatcher;
        $this->builder = $builder;
    }

    /**
     * @param \Uc\EventHub\Contracts\EventPayload $payload
     *
     * @return void
     */
    public function send(EventPayload $payload): void
    {
        $message = $this->builder
            ->setTopicName(config('event-hub.kafka_topic'))
            ->setKey($payload->event)
            ->setBody($payload)
            ->getMessage();

        $this->dispatcher->dispatch(new ProduceMessageEvent($message));
    }
}
