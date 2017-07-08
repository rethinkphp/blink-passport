<?php

namespace blink\passport\models;

use blink\core\Object;
use League\OAuth2\Server\Entities\ClientEntityInterface;

/**
 * Class App
 *
 * @package blink\passport\models
 */
class App extends Object implements ClientEntityInterface
{
    public $id;
    public $name;
    public $redirectUri;

    public function getIdentifier()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getRedirectUri()
    {
        return $this->redirectUri;
    }
}