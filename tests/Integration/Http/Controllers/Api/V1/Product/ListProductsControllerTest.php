<?php

/**
 * Class ListProductsControllerTest
 */
class ListProductsControllerTest extends TestCase
{

    /** @test */
    public function shouldReturnUnAuthorizedForInvalidUser(): void
    {
        $result = $this->get('/api/v1/product');

        $actualStatusCode = $result->response->getStatusCode();
        $actualContent = json_decode($result->response->getContent(), true);

        $expectedContent = ['ok' => false, 'error' => 'Unauthorized.'];

        $this->assertEquals(401, $actualStatusCode);
        $this->assertEquals($expectedContent, $actualContent);
    }
}
