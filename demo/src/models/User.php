<?php

namespace app\models;

use blink\auth\Authenticatable;
use blink\core\Object;
use blink\core\InvalidParamException;

/**
 * Class User
 *
 * @package app\models
 */
class User extends Object implements Authenticatable
{
    public static $users = [
        ['id' => 1, 'name' => 'user1', 'password' => 'user1'],
        ['id' => 2, 'name' => 'user2', 'password' => 'user2']
    ];

    public $id;
    public $name;
    public $password;

    /**
     * @inheritDoc
     */
    public static function findIdentity($id)
    {
        if (is_numeric($id)) {
            $key = 'id';
            $value = $id;
        } else if (is_array($id) && isset($id['name'])) {
            $key = 'name';
            $value = $id['name'];
        } else {
            throw new InvalidParamException("The param: id is invalid");
        }

        foreach (static::$users as $user) {
            if ($user[$key] == $value) {
                return new static($user);
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function getAuthId()
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
