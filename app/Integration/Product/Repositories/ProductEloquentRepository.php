<?php

namespace App\Integration\Product\Repositories;

use App\Models\Product;
use App\Models\User;
use Domain\Product\Repository\ProductRepository;
use Domain\Product\Repository\Exceptions\ErrorDeletingProductException;
use Domain\Product\Repository\Exceptions\ErrorUpdatingProductException;

class ProductEloquentRepository implements ProductRepository
{
    /**
     * @param int $productId
     * @return Product|null
     */
    public function getById(int $productId): ?Product
    {
        return Product::query()->find($productId);
    }

    public function create(array $productData): void
    {
        Product::create($productData);
    }

    /**
     * @param array $productData
     * @param int $productId
     * @throws ErrorUpdatingProductException
     */
    public function update(array $productData, int $productId): void
    {
        $result = Product::query()
            ->where('id', '=', $productId)
            ->update($productData);

        if ($result <= 0) {
            throw new ErrorUpdatingProductException('Error updating product '.$productId);
        }
    }

    /**
     * @param int $productId
     * @throws ErrorDeletingProductException
     */
    public function destroy(int $productId): void
    {
        $result = Product::query()
            ->where('id', '=', $productId)
            ->delete();

        if ($result <= 0) {
            throw new ErrorDeletingProductException('Error deleting product '.$productId);
        }
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function all(): \Illuminate\Support\Collection
    {
        return Product::all();
    }
}
