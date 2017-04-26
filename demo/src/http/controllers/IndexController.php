<?php

namespace app\http\controllers;

use blink\core\Object;
use blink\http\Request;
use blink\http\Response;


class IndexController extends Object
{
    public function before($id, Request $request)
    {
    }

    public function sayHello()
    {
        return 'Hello world, Blink.';
    }

    public function after($id, Request $request, Response $response)
    {

    }
}
