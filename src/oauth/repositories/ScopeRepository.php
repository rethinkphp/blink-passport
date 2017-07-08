<?php
/**
 * Created by PhpStorm.
 * User: seiue
 * Date: 16/4/11
 * Time: 下午3:09
 */

namespace blink\passport\oauth\repositories;


use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\ScopeRepositoryInterface;

/**
 * Class ScopeRepository
 * @package chalk\oauth\repositories
 */
class ScopeRepository implements ScopeRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function getScopeEntityByIdentifier($identifier)
    {
        // TODO: Implement getScopeEntityByIdentifier() method.
    }

    /**
     * @inheritDoc
     */
    public function finalizeScopes(
        array $scopes,
        $grantType,
        ClientEntityInterface $clientEntity,
        $userIdentifier = null
    )
    {
        // TODO: Implement finalizeScopes() method.

        return [];
    }
}
