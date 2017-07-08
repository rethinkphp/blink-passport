<?php

namespace blink\passport\models;


use blink\auth\Authenticatable;
use blink\core\Object;
use League\OAuth2\Server\Entities\UserEntityInterface;

/**
 * Class User
 *
 * @package blink\passport\models
 */
class User extends Object implements UserEntityInterface, Authenticatable
{
    public $id;

    public static function findIdentity($id)
    {
        if ($id == 1) {
            return new static(['id' => $id]);
        }
    }

    public function getAuthId()
    {
        return $this->id;
    }

    public function validatePassword($password)
    {
        return true;
    }

    public function getIdentifier()
    {
        return $this->id;
    }
}