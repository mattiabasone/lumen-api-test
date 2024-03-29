<?php

declare(strict_types=1);

namespace Domain\Product\Repository;

use App\Models\Product;
use Illuminate\Support\Collection;

interface ProductRepository
{
    public function getById(int $productId): ?Product;

    public function exists(int $productId): bool;

    public function create(array $productData): Product;

    public function update(array $productData, int $productId): void;

    public function destroy(int $productId): void;

    public function all(): Collection;
}
