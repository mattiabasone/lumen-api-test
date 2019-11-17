<?php

class DashboardControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function shouldReturnPage(): void
    {
        $result = $this->get('/');

        $actualStatusCode = $result->response->getStatusCode();
        $this->assertEquals(200, $actualStatusCode);
    }
}
