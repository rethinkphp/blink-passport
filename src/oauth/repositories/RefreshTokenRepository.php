<?php

namespace blink\passport\oauth\repositories;


use blink\passport\oauth\RefreshToken;
use League\OAuth2\Server\Entities\RefreshTokenEntityInterface;
use League\OAuth2\Server\Repositories\RefreshTokenRepositoryInterface;

/**
 * Class RefreshTokenRepository
 * @package chalk\oauth\repositories
 */
class RefreshTokenRepository implements RefreshTokenRepositoryInterface
{
    public function persistNewRefreshToken(RefreshTokenEntityInterface $entity)
    {
        session()->put($entity);
    }

    public function revokeRefreshToken($tokenId)
    {
        session()->destroy($tokenId);
    }

    public function isRefreshTokenRevoked($tokenId)
    {
        return !session()->get($tokenId);
    }

    public function getNewRefreshToken()
    {
        return new RefreshToken();
    }
}
