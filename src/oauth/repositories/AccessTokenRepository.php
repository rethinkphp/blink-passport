<?php

namespace blink\passport\oauth\repositories;


use blink\passport\oauth\AccessToken;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Repositories\AccessTokenRepositoryInterface;

/**
 * Class AccessTokenRepository
 *
 * @package chalk\oauth\repositories
 */
class AccessTokenRepository implements AccessTokenRepositoryInterface
{
    public function persistNewAccessToken(AccessTokenEntityInterface $entity)
    {
        session()->put($entity);
    }

    public function revokeAccessToken($tokenId)
    {
        session()->destroy($tokenId);
    }

    public function isAccessTokenRevoked($tokenId)
    {
        return !session()->get($tokenId);
    }

    public function getNewToken(ClientEntityInterface $clientEntity, array $scopes, $userIdentifier = null)
    {
        return new AccessToken();
    }
}
