<?php

namespace blink\passport\tests;

/**
 * Class OAuthTest
 *
 * @package blink\passport\tests
 */
class OAuthTest extends TestCase
{
    public function testPasswordGrant()
    {
        $actor = $this->actor()
            ->withHeaders(['Content-Type' => 'application/json'])
            ->post('/oauth/token', [
                'grant_type' => 'password',
                'client_id' => 2,
                'client_secret' => 'secret1',
                'username' => 'root@rethinkphp.com',
                'password' => '123456',
            ])
            ->dumpJson()
            ->seeStatusCode(201)
            ->seeHeader('cache-control', 'no-store')
            ->seeJsonStructure(['token_type', 'expires_in', 'access_token', 'refresh_token']);

        $result = $actor->asJson();

        $this->actor()
            ->withHeaders(['Content-Type' => 'application/json'])
            ->withHeaders(['Authorization' => 'Bearer ' . $result['access_token']])
            ->get('/oauth/info')
            ->seeStatusCode(200)
            ->seeJsonStructure(['id']);

        $this->actor()
            ->withHeaders(['Content-Type' => 'application/json'])
            ->post('/oauth/token', [
                'grant_type' => 'refresh_token',
                'client_id' => 2,
                'client_secret' => 'secret1',
                'refresh_token' => $result['refresh_token'],
            ])
            ->dumpJson()
            ->seeStatusCode(201);
    }}