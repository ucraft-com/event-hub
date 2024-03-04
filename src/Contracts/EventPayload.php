<?php

declare(strict_types=1);

namespace Uc\EventHub\Contracts;

use JsonSerializable;

/**
 * @property string            event
 * @property PropertyInterface properties
 * @property ContextInterface  context
 */
class EventPayload implements JsonSerializable
{

    /**
     * @param string                                   $event
     * @param \Uc\EventHub\Contracts\PropertyInterface $properties
     * @param \Uc\EventHub\Contracts\ContextInterface  $context
     */
    public function __construct(
        protected string $event,
        protected PropertyInterface $properties,
        protected ContextInterface $context,
    ) {
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'event'      => $this->event,
            'properties' => $this->properties,
            'context'    => $this->context,
        ];
    }

    /**
     * @return string
     */
    public function getEvent(): string
    {
        return $this->event;
    }
}
