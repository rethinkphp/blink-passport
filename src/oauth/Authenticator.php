<?php

namespace blink\passport\oauth;

use blink\http\Request;
use blink\passport\models\User;
use blink\passport\oauth\repositories\AccessTokenRepository;
use blink\session\Session;
use League\OAuth2\Server\ResourceServer;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequest;
use blink\core\MiddlewareContract;
use League\OAuth2\Server\Exception\OAuthServerException;

/**
 * Middleware for OAuth Authentication
 *
 * @package chalk\oauth
 */
class Authenticator implements MiddlewareContract
{
    /**
     * @param \blink\http\Request $request
     * @throws OAuthServerException
     */
    public function handle($request)
    {
        $value = $request->headers->first('Authorization');
        if (!$value) {
            return;
        }

        $parts = preg_split('/\s+/', $value);
        if (count($parts) < 2 && strtolower($parts[0]) != 'bearer') {
            return;
        }

        $server = new ResourceServer(new AccessTokenRepository(), auth()->publicKey);

        $psrRequest = new ServerRequest([], [], null, null, 'php://input', $request->getHeaders()->all(), [], [], $request->getBody()->all());


        try {
            $psrRequest = $server->validateAuthenticatedRequest($psrRequest);

            $params = $psrRequest->getAttributes();

            $session = session()->get($params['oauth_access_token_id']);

            if (!$session) {
                return;
            }

            $request->setSession($session);
        } catch (OAuthServerException $e) {
            //$psrResponse = new Response();
            //response()->data = $e->generateHttpResponse($psrResponse);
        }
    }
}
