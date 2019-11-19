<?php

/**
 * Class StoreWishlistsControllerTest
 */
class StoreWishlistsControllerTest extends TestCase
{
    /** @test */
    public function shouldReturnUnAuthorizedForInvalidUser(): void
    {
        $this->json('POST', '/api/v1/wishlist')
            ->seeStatusCode(401)
            ->seeJsonEquals(['ok' => false, 'error' => 'Unauthorized.']);
    }

    /** @test */
    public function shouldStoreWishlist(): void
    {
        /** @var \App\Models\User $user */
        $user = \App\Models\User::query()
            ->where('role', '=', 'user')
            ->first();

        \App\Models\Wishlist::create([
            'name' => 'TestWishlist',
            'user_id' => $user->id
        ]);

        $this->actingAs($user)
            ->json(
                'POST',
                '/api/v1/wishlist',
                ['name' => 'MyNewWishlist_9898989']
            )
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'ok',
                'wishlist' => [
                    'id',
                    'user_id',
                    'name',
                    'created_at',
                    'updated_at'
                ]
            ]);
    }
}
