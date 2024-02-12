<?php

declare(strict_types=1);

namespace Uc\EventHub\Facades;

use Illuminate\Support\Facades\Facade;
use Uc\EventHub\Contracts\PayloadInterface;
use Uc\EventHub\Client;

/**
 * EventHub facade.
 *
 * @package Uc\EventHub\Facades
 *
 * @method static array send(PayloadInterface $payload, string $event)
 */
class EventHub extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Client::class;
    }
}
