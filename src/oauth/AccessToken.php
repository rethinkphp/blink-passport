<?php

namespace blink\passport\oauth;


use blink\session\Session;
use League\OAuth2\Server\CryptKey;
use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\RefreshTokenEntityInterface;
use League\OAuth2\Server\Entities\ScopeEntityInterface;
use League\OAuth2\Server\Entities\Traits\AccessTokenTrait;

/**
 * Class AccessToken
 *
 * @package blink\passport\oauth
 */
class AccessToken extends Session implements AccessTokenEntityInterface
{
    use AccessTokenTrait;

    public function getIdentifier()
    {
        return $this->id;
    }

    public function setIdentifier($identifier)
    {
        $this->id = $identifier;
    }

    public function getExpiryDateTime()
    {
        return \DateTime::createFromFormat('Y-m-d H:i:s', $this->get('expires_in'));
    }

    public function setExpiryDateTime(\DateTime $dateTime)
    {
        $this->set('expires_in', $dateTime->format('Y-m-d H:i:s'));
    }

    public function setUserIdentifier($identifier)
    {
        $this->set('auth_id', $identifier);
    }

    public function getUserIdentifier()
    {
        return $this->get('auth_id');
    }

    public $client;

    public function getClient()
    {
        return $this->client;
    }

    public function setClient(ClientEntityInterface $client)
    {
        $this->client = $client;
    }

    public function addScope(ScopeEntityInterface $scope)
    {
        $scopes = $this->get('scopes', []);
        $scopes[] = $scope->getIdentifier();

        $this->set('scopes', $scopes);
    }

    public function getScopes()
    {
        return $this->get('scopes', []);
    }
}