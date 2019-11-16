<?php

declare(strict_types=1);

namespace Domain\User\Repository;

use App\Models\User;
use Illuminate\Support\Collection;

interface UserRepository
{
    public function getById(int $userId): ?User;

    public function create(array $userData): void;

    public function update(array $userData, int $userId): void;

    public function destroy(int $userId): void;

    public function all(): Collection;
}
