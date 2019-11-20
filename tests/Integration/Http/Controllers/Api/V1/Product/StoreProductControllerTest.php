<?php

/**
 * Class ListProductsControllerTest
 */
class StoreProductControllerTest extends TestCase
{
    /** @test */
    public function shouldReturnUnAuthorizedForInvalidUser(): void
    {
        $this->json('POST', '/api/v1/product')
            ->seeStatusCode(401)
            ->seeJsonEquals(['ok' => false, 'error' => 'Unauthorized.']);
    }

    /** @test */
    public function shouldNotAllowAccessToStandardUser(): void
    {
        /** @var \App\Models\User $user */
        $user = \App\Models\User::query()
            ->where('role', '=', 'user')
            ->first();

        $this->actingAs($user)
            ->json('POST', '/api/v1/product', ['name' => 't001', 'price' => 10])
            ->seeStatusCode(403)
            ->seeJsonEquals(['ok' => false, 'error' => 'Forbidden.']);
    }

    /** @test */
    public function shouldStoreProductAsAdmin(): void
    {
        /** @var \App\Models\User $user */
        $user = \App\Models\User::query()
            ->where('role', '=', 'admin')
            ->first();

        $this->actingAs($user)
            ->json('POST', '/api/v1/product', ['name' => 'TestInsertAdmin', 'price' => 10])
            ->seeStatusCode(200)
            ->seeJsonStructure(['ok', 'product']);

        $this->seeInDatabase('products', ['name' => 'TestInsertAdmin']);
    }
}
