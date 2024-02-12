<?php

declare(strict_types=1);

namespace Uc\EventHub;

use Illuminate\Events\Dispatcher;
use Uc\KafkaProducer\Events\ProduceMessageEvent;
use Uc\KafkaProducer\MessageBuilder;
use Uc\EventHub\Contracts\PayloadInterface;

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
     * @param \Uc\EventHub\Contracts\PayloadInterface $payload
     * @param string                                  $event
     *
     * @return void
     */
    public function send(PayloadInterface $payload, string $event): void
    {

        $message = $this->builder
            ->setTopicName(config('event-hub.kafka_topic'))
            ->setKey($event)
            ->setBody($payload)
            ->getMessage();

        $this->dispatcher->dispatch(new ProduceMessageEvent($message));
    }
}
