<?php

namespace App\Integration\Product\Repositories;

use App\Models\Product;
use App\Models\User;
use Domain\User\Repository\Exceptions\ErrorDeletingUserException;
use Domain\User\Repository\Exceptions\ErrorUpdatingUserException;
use Domain\User\Repository\UserRepository;

class UserEloquentRepository implements UserRepository
{
    /**
     * @param int $productId
     * @return User|null
     */
    public function getById(int $productId): ?User
    {
        return User::find($productId);
    }

    /**
     * @param array $productData
     */
    public function create(array $productData): void
    {
        User::create($productData);
    }

    /**
     * @param array $productData
     * @param int $productId
     * @throws ErrorUpdatingUserException
     */
    public function update(array $productData, int $productId): void
    {
        $result = User::query()
            ->where('id', '=', $productId)
            ->update($productData);

        if ($result <= 0) {
            throw new ErrorUpdatingUserException('Error updating product '.$productId);
        }
    }

    /**
     * @param int $productId
     * @throws ErrorDeletingUserException
     */
    public function destroy(int $productId): void
    {
        $result = User::query()
            ->where('id', '=', $productId)
            ->delete();

        if ($result <= 0) {
            throw new ErrorDeletingUserException('Error deleting product '.$productId);
        }
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function all(): \Illuminate\Support\Collection
    {
        return User::all();
    }
}
