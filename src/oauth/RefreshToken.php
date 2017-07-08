<?php

namespace blink\passport\oauth;

use blink\session\Session;
use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Entities\RefreshTokenEntityInterface;

/**
 * Class RefreshToken
 *
 * @package blink\passport\oauth
 */
class RefreshToken extends Session implements RefreshTokenEntityInterface
{
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

    public $accessToken;

    public function setAccessToken(AccessTokenEntityInterface $accessToken)
    {
        $this->accessToken = $accessToken;
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }
}