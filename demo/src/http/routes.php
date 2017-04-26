<?php
return [
    ['GET', '/', 'IndexController@sayHello'],
    ['POST', '/auth', 'AuthController@postAuth'],
    ['GET', '/auth', 'AuthController@getInfo'],
    ['GET', '/aaa', 'IndexController@sayHello'],
];
