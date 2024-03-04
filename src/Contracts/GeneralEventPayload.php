<?php

declare(strict_types=1);

namespace Uc\EventHub\Contracts;

/**
 * @property string               event
 * @property PayloadInterface properties
 */
class GeneralEventPayload implements PayloadInterface
{
    /**
     * @var string
     */
    public string $event;

    /**
     * @var PayloadInterface
     */
    public PayloadInterface $properties;

    /**
     * @var ContextInterface
     */
    public ContextInterface $context;
}
