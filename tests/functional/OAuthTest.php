<?php

namespace blink\passport\tests;

/**
 * Class OAuthTest
 *
 * @package blink\passport\tests
 */
class OAuthTest extends TestCase
{
    public function testHelloWord()
    {
        $this->actor()
            ->get('/')
            ->seeContent('Hello world, Blink.');
    }
}