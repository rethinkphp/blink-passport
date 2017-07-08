<?php

namespace blink\passport\oauth\repositories;

use blink\passport\models\User;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\UserRepositoryInterface;

/**
 * Class UserRepository
 *
 * @package chalk\oauth\repositories
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function getUserEntityByUserCredentials($username, $password, $grantType, ClientEntityInterface $clientEntity)
    {
        return new User(['id' => 1]);
    }
}
