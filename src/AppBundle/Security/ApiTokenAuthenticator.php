<?php

namespace AppBundle\Security;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;


class ApiTokenAuthenticator extends AbstractGuardAuthenticator
{
    const API_KEY_NAME = "apikey";

    public function start(Request $request, AuthenticationException $authException = null)
    {
        return new JsonResponse(["message" => "Authentication token required"], 401);
    }

    public function getCredentials(Request $request)
    {
        if (!$token = $request->headers->get(self::API_KEY_NAME)) {

            return null;
        }

        return ['token' => $token];
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $apiToken = $credentials['token'];
        
        return $userProvider->loadUserByUsername($apiToken);
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return true;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return new JsonResponse(["message" => $exception->getMessage()], 403);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return null;
    }

    public function supportsRememberMe()
    {
        return false;
    }
}
