<?php

namespace blink\passport;

use blink\core\Application;
use blink\core\Object;
use blink\core\PluginContract;
use blink\passport\services\Users;
use blink\passport\services\OAuth;

/**
 * Class Passport
 *
 * @package blink\passport
 */
class Passport extends Object implements PluginContract
{
    public $users = Users::class;

    /**
     * @inheritDoc
     */
    public function install(Application $app)
    {
        $this->installServices($app);

        $this->installRoutes($app);
    }

    protected function installServices(Application $app)
    {
        $services = [
            'passport.users' => $this->users,
        ];

        foreach ($services as $id => $config) {
            $app->bind($id, $config);
        }
    }

    protected function installRoutes(Application $app)
    {
        $routes = require __DIR__ . '/routes.php';
        $handlerPrefix = '\blink\\passport\\controllers\\';

        foreach ($routes as $route) {
            list($method, $uri, $handler) = $route;
            $app->route($method, $uri, $handlerPrefix . $handler);
        }
    }
}
