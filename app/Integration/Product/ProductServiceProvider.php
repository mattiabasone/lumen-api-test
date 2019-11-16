<?php

namespace App\Integration\Product;

use Illuminate\Support\ServiceProvider;
use Domain\Product\Repository\ProductRepository;
use App\Integration\Product\Repositories\ProductEloquentRepository;

/**
 * Class ProductServiceProvider
 */
class ProductServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(ProductRepository::class, ProductEloquentRepository::class);
    }
}
