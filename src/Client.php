<?php

declare(strict_types=1);

namespace Uc\EventHub;

use Illuminate\Events\Dispatcher;
use Uc\EventHub\Contracts\ContextInterface;
use Uc\KafkaProducer\Events\ProduceMessageEvent;
use Uc\KafkaProducer\MessageBuilder;
use Uc\EventHub\Contracts\PayloadInterface;
use Uc\EventHub\Contracts\GeneralEventPayload;

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
     * @param \Uc\EventHub\Contracts\PayloadInterface $properties
     * @param \Uc\EventHub\Contracts\ContextInterface $context
     * @param string                                  $event
     *
     * @return void
     */
    public function send(PayloadInterface $properties, ContextInterface $context, string $event): void
    {
        $payload = new GeneralEventPayload;

        $payload->properties = $properties;

        $payload->context = $context;

        $payload->event = $event;

        $message = $this->builder
            ->setTopicName(config('event-hub.kafka_topic'))
            ->setKey($event)
            ->setBody($payload)
            ->getMessage();

        $this->dispatcher->dispatch(new ProduceMessageEvent($message));
    }
}
