<?php

namespace blink\passport\oauth;

use blink\auth\Auth;
use blink\http\Request;
use blink\passport\oauth\repositories\ClientRepository;
use blink\passport\oauth\repositories\AccessTokenRepository;
use League\OAuth2\Server\Exception\OAuthServerException;
use League\OAuth2\Server\Grant\ClientCredentialsGrant;
use League\OAuth2\Server\Grant\PasswordGrant;
use League\OAuth2\Server\Grant\RefreshTokenGrant;
use League\OAuth2\Server\AuthorizationServer;
use blink\passport\oauth\repositories\RefreshTokenRepository;
use blink\passport\oauth\repositories\ScopeRepository;
use blink\passport\oauth\repositories\UserRepository;
use Zend\Diactoros\ServerRequest;

/**
 * Class OAuth
 *
 * @package blink\passport\src\services
 */
class OAuth extends Auth
{
    public $privateKey;
    public $publicKey;

    protected $clientRepository;
    protected $accessTokenRepository;

    protected $_server;

    public function init()
    {
        $this->clientRepository = new ClientRepository();
        $this->accessTokenRepository = new AccessTokenRepository();
    }

    public function getServer()
    {
        if (!$this->_server) {
            $this->_server = new AuthorizationServer(
                $this->clientRepository,
                $this->accessTokenRepository,
                new ScopeRepository(),
                $this->privateKey,
                $this->publicKey
            );

            $this->_server->setEncryptionKey('lxZFUEsBCJ2Yb14IF2ygAHI5N4+ZAUXXaSeeJm6+twsUmIen');

            $this->_server->enableGrantType(new ClientCredentialsGrant(), new \DateInterval('P1D'));

            $passwordGrant = new PasswordGrant(new UserRepository(), new RefreshTokenRepository());
            $refreshGrant  = new RefreshTokenGrant(new RefreshTokenRepository());

            $this->_server->enableGrantType($passwordGrant, new \DateInterval('P1D'));
            $this->_server->enableGrantType($refreshGrant, new \DateInterval('P1D'));
        }

        return $this->_server;
    }

    protected function convertToPsrRequest($request)
    {
        $psrRequest = new ServerRequest([], [], null, null, 'php://input', $request->getHeaders()->all(), [], [], $request->getBody()->all());

        return $psrRequest;
    }

    public function authorize(Request $request)
    {
        $psrResponse = new \Zend\Diactoros\Response();

        try {
            $response = $this->getServer()->respondToAccessTokenRequest($this->convertToPsrRequest($request), $psrResponse);
            return $response->withStatus(201);
        } catch (OAuthServerException $e) {
            return $e->generateHttpResponse($psrResponse);
        }
    }
}
