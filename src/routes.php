<?php
return [
    ['GET', '/users', 'UserController@index'],
    ['POST', '/users', 'UserController@create'],
    ['GET', '/users/{id}', 'UserController@view'],
    ['PATCH', '/users/{id}', 'UserController@update'],
    ['DELETE', '/users/{id}', 'UserController@delete'],
];
