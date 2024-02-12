<?php

declare(strict_types=1);

namespace Uc\EventHub;

use Illuminate\Support\ServiceProvider;

class EventHubServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->registerPublishing();
        }

        $this->registerResources();
    }

    /**
     * Register the package resources.
     *
     * @return void
     */
    private function registerResources(): void
    {
        $this->registerFacades();
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    protected function registerPublishing(): void
    {
        $this->publishes([
            __DIR__.'/../config/event-hub.php' => config_path('event-hub.php'),
        ]);
    }

    /**
     * @return void
     */
    private function registerFacades(): void
    {
        $this->app->singleton(Client::class, Client::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(): void
    {
    }
}
