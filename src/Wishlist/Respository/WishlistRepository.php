<?php

declare(strict_types=1);

namespace Domain\Wishlist\Repository;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Collection;

interface WishlistRepository
{
    public function getById(int $wishlistId): ?Wishlist;

    public function userIsOwner(int $wishlistId, int $userId): bool;

    public function create(array $wishlistData): Wishlist;

    public function exists(int $wishlistId): bool;

    public function update(array $wishlistData, int $wishlistId): void;

    public function destroy(int $wishlistId): void;

    public function all(): Collection;

    public function allForUser(int $userId): Collection;

    public function addProduct(Wishlist $wishlist, Product $product): void;

    public function removeProduct(Wishlist $wishlist, Product $product): void;
}
