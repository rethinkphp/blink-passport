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
            $request = $server->validateAuthenticatedRequest($psrRequest);

            $params = $request->getAttributes();

            $user = User::findIdentity($params['oauth_user_id']);

            if (!$user) {
                return;
            }

            auth()->login($user, true);
        } catch (OAuthServerException $e) {
            //$psrResponse = new Response();
            //response()->data = $e->generateHttpResponse($psrResponse);
        }
    }
}
