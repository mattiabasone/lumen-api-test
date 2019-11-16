<?php

namespace App\Integration\Product;

use App\Integration\Product\Repositories\UserEloquentRepository;
use Domain\User\Repository\UserRepository;
use Illuminate\Support\ServiceProvider;

/**
 * Class UserServiceProvider
 */
class UserServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(UserRepository::class, UserEloquentRepository::class);
    }
}
