<?php

namespace App\Integration\Product;

use App\Integration\Product\Repositories\WishlistEloquentRepository;
use Domain\Wishlist\Repository\WishlistRepository;
use Illuminate\Support\ServiceProvider;

/**
 * Class UserServiceProvider
 */
class WishlistServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(WishlistRepository::class, WishlistEloquentRepository::class);
    }
}
