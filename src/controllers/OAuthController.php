<?php

namespace blink\passport\controllers;

use blink\core\Object;
use blink\http\Request;
use blink\http\Response;
use blink\passport\models\User;
use Psr\Http\Message\ResponseInterface;

/**
 * Class OAuthController
 *
 * @package blink\passport\controllers
 */
class OAuthController extends Object
{
    public function authorize(Request $request, Response $response)
    {
        $psrResponse = auth()->authorize($request);

        return $this->convertPsrResponse($psrResponse, $response);
    }

    public function info(Request $request)
    {
        if ($request->guest()) {
            abort(401);
        }

        return new User(['id' => 1]);
    }

    protected function convertPsrResponse(ResponseInterface $psrResponse, Response $response)
    {
        $response->data = (string)$psrResponse->getBody();

        foreach ($psrResponse->getHeaders() as $key => $value) {
            $response->headers->set($key, $value);
        }
        $response->statusCode = $psrResponse->getStatusCode();

        return $response;
    }
}