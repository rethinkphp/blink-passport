<?php

namespace blink\passport\tests;

use blink\testing\TestCase as BaseTestCase;

/**
 * Class TestCase
 *
 * @package blink\passport\tests
 */
class TestCase extends BaseTestCase
{
    public function createApplication()
    {
        /** @var \blink\core\Application $app */
        $app = require __DIR__ . '/../demo/src/bootstrap.php';

        return $app;
    }
}