<?php

/**
 * Class ListProductsControllerTest
 */
class ListProductsControllerTest extends TestCase
{
    /** @test */
    public function shouldReturnUnAuthorizedForInvalidUser(): void
    {
        $this->json('GET', '/api/v1/product')
            ->seeStatusCode(401)
            ->seeJsonEquals(['ok' => false, 'error' => 'Unauthorized.']);
    }

    /** @test */
    public function shouldListProducts(): void
    {
        /** @var \App\Models\User $user */
        $user = \App\Models\User::query()
            ->where('role', '=', 'user')
            ->first();

        $this->actingAs($user)
            ->json('GET', '/api/v1/product')
            ->seeStatusCode(200)
            ->seeJsonStructure(['ok', 'products']);
    }
}
