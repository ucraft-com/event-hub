<?php

declare(strict_types = 1);

namespace Uc\KafkaProducer\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Uc\EventHub\EventHubServiceProvider;

class TestCase extends BaseTestCase
{
    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp() : void
    {
        parent::setUp();
    }

    /**
     * Get package providers.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array<int, class-string>
     */
    protected function getPackageProviders($app) : array
    {
        return [
            EventHubServiceProvider::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app) : void
    {
        // Perform environment setup.
    }
}
