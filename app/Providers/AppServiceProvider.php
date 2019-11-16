<?php

namespace App\Providers;

use App\Integration\Product\ProductServiceProvider;
use App\Integration\Product\UserServiceProvider;
use App\Integration\Product\WishlistServiceProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        \Dusterio\LumenPassport\LumenPassport::routes($this->app, ['prefix' => 'api/v1/oauth']);
        $this->registerRepositories();
    }

    /**
     *
     */
    private function registerRepositories(): void
    {
        $this->app->register(UserServiceProvider::class);
        $this->app->register(ProductServiceProvider::class);
        $this->app->register(WishlistServiceProvider::class);
    }
}
