<?php

namespace App\Integration\Product\Repositories;

use App\Models\Product;
use App\Models\Wishlist;
use Domain\Wishlist\Repository\Exceptions\ErrorDeletingWishlistException;
use Domain\Wishlist\Repository\Exceptions\ErrorUpdatingWishlistException;
use Domain\Wishlist\Repository\WishlistRepository;
use Illuminate\Support\Collection;

class WishlistEloquentRepository implements WishlistRepository
{
    /**
     * @param int $wishlistId
     * @return Wishlist|null
     */
    public function getById(int $wishlistId): ?Wishlist
    {
        return Wishlist::query()->find($wishlistId);
    }

    /**
     * Checks wishlist ownership
     *
     * @param int $wishlistId
     * @param int $userId
     * @return bool
     */
    public function userIsOwner(int $wishlistId, int $userId): bool
    {
        return Wishlist::query()
            ->where('id', '=', $wishlistId)
            ->where('user_id', '=', $userId)
            ->exists();
    }

    /**
     * @param array $productData
     * @return Wishlist
     */
    public function create(array $productData): Wishlist
    {
        return Wishlist::create($productData);
    }

    /**
     * @param int $wishlistId
     * @return bool
     */
    public function exists(int $wishlistId): bool
    {
        return Wishlist::query()
            ->where('id', '=', $wishlistId)
            ->exists();
    }

    /**
     * @param array $productData
     * @param int $wishlistId
     * @throws ErrorUpdatingWishlistException
     */
    public function update(array $productData, int $wishlistId): void
    {
        $result = Wishlist::query()
            ->where('id', '=', $wishlistId)
            ->update($productData);

        if ($result <= 0) {
            throw new ErrorUpdatingWishlistException('Error updating wishlist #'.$wishlistId);
        }
    }

    /**
     * @param int $wishlistId
     * @throws ErrorDeletingWishlistException
     */
    public function destroy(int $wishlistId): void
    {
        $result = Wishlist::query()
            ->where('id', '=', $wishlistId)
            ->delete();

        if ($result <= 0) {
            throw new ErrorDeletingWishlistException('Error deleting wishlist #'.$wishlistId);
        }
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function all(): \Illuminate\Support\Collection
    {
        return Wishlist::all();
    }

    /**
     * @param int $userId
     * @return Collection
     */
    public function allForUser($userId): Collection
    {
        return Wishlist::query()
            ->where('user_id', '=', $userId)
            ->get();
    }

    public function addProduct(Wishlist $wishlist, Product $product): void
    {
        $wishlist->products()->syncWithoutDetaching([$product->id]);
    }

    public function removeProduct(Wishlist $wishlist, Product $product): void
    {
        $wishlist->products()->detach([$product->id]);
    }
}
