<?php

/**
 * Class AddProductToWishlistsControllerTest
 */
class AddProductToWishlistsControllerTest extends TestCase
{
    /** @test */
    public function shouldReturnUnAuthorizedForInvalidUser(): void
    {
        $this->json('POST', '/api/v1/wishlist/1/product/123')
            ->seeStatusCode(401)
            ->seeJsonEquals(['ok' => false, 'error' => 'Unauthorized.']);
    }

    /** @test */
    public function shouldAddProductToWishlist(): void
    {
        /** @var \App\Models\Wishlist $wishlist */
        $wishlist = \App\Models\Wishlist::first();

        /** @var \App\Models\Product $product */
        $product = \App\Models\Product::create(['name' => 'PippoProduct', 'price' => 90.90]);

        $this->actingAs($wishlist->user)
            ->json('POST', '/api/v1/wishlist/'.$wishlist->id.'/product/'.$product->id)
            ->seeStatusCode(200)
            ->seeJsonEquals(['ok' => true]);
    }
}
