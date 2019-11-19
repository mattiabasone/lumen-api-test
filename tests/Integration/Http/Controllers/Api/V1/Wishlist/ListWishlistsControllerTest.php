<?php

/**
 * Class ListWishlistsControllerTest
 */
class ListWishlistsControllerTest extends TestCase
{
    /** @test */
    public function shouldReturnUnAuthorizedForInvalidUser(): void
    {
        $this->json('GET', '/api/v1/wishlist')
            ->seeStatusCode(401)
            ->seeJsonEquals(['ok' => false, 'error' => 'Unauthorized.']);
    }

    /** @test */
    public function shouldDisplayEmptyWishlist(): void
    {
        /** @var \App\Models\User $user */
        $user = \App\Models\User::query()->create([
            'name' => 'TestUserName',
            'surname' => 'TestUserSurname',
            'email' => 'pippo@example.org',
            'role' => 'user',
            'password' => \Illuminate\Support\Facades\Hash::make('pippo')
        ]);

        $this->actingAs($user)
            ->json('GET', '/api/v1/wishlist')
            ->seeStatusCode(200)
            ->seeJsonEquals(['ok' => true, 'wishlists' => []]);
    }

    /** @test */
    public function shouldListWishlist(): void
    {
        /** @var \App\Models\User $user */
        $user = \App\Models\User::query()
            ->where('role', '=', 'user')
            ->first();

        \App\Models\Wishlist::create([
            'name' => 'TestWishlist',
            'user_id' => $user->id
        ]);

        $result = $this->actingAs($user)
            ->json('GET', '/api/v1/wishlist')
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'ok',
                'wishlists' => [
                    [
                        'id',
                        'user_id',
                        'name',
                        'created_at',
                        'updated_at'
                    ]
                ]
            ]);
    }
}
