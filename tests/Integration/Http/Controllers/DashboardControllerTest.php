<?php

class DashboardControllerTest extends TestCase
{
    /** @test */
    public function shouldReturnPage(): void
    {
        $result = $this->get('/');

        $actualStatusCode = $result->response->getStatusCode();
        $this->assertEquals(200, $actualStatusCode);
    }
}
