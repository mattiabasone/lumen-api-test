<?php

/**
 * Class TestCase
 */
abstract class TestCase extends Laravel\Lumen\Testing\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        app('db')->beginTransaction();
    }

    public function tearDown(): void
    {
        app('db')->rollback();
        parent::tearDown();
    }

    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }
}
