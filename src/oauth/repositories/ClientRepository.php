<?php

namespace blink\passport\oauth\repositories;


use blink\passport\models\App;
use League\OAuth2\Server\Repositories\ClientRepositoryInterface;

/**
 * Class ClientRepository
 *
 * @package chalk\oauth\repositories
 */
class ClientRepository implements ClientRepositoryInterface
{

    public function getClientEntity($clientIdentifier, $grantType, $clientSecret = null, $mustValidateSecret = true)
    {
        if ($clientIdentifier != 2) {
            return;
        }

        return new App(['id' => 2]);
    }
}
