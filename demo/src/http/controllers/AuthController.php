<?php

namespace app\http\controllers;


use blink\http\Request;
use blink\http\Response;

class AuthController
{
    public function postAuth(Request $request, Response $response)
    {
        $user = auth()->attempt($request->body->all());
        if (!$user) {
            abort(422, 'Invalid username or password');
        }

        $response->headers->with('X-Session-Id', $request->sessionId);
    }

    public function getInfo(Request $request)
    {
        if ($request->guest()) {
            abort(403);
        }

        return $request->user();
    }
}
