<?php

declare(strict_types=1);

namespace App\Security;

use KnpU\OAuth2ClientBundle\Client\Provider\GithubClient;
use KnpU\OAuth2ClientBundle\Security\Authenticator\SocialAuthenticator;
use League\OAuth2\Client\Token\AccessToken;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class GithubAuthenticator extends SocialAuthenticator
{
    /** @var string */
    public const ACCESS_TOKEN = 'github_access_token';

    /** @var GithubClient */
    private $githubClient;

    /** @var RouterInterface */
    private $router;

    /** @var SessionInterface */
    private $session;

    /**
     * @param GithubClient $githubClient
     * @param RouterInterface $router
     * @param SessionInterface $session
     */
    public function __construct(GithubClient $githubClient, RouterInterface $router, SessionInterface $session)
    {
        $this->githubClient = $githubClient;
        $this->router = $router;
        $this->session = $session;
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function supports(Request $request): bool
    {
        return 'authorization_check' === $request->attributes->get('_route');
    }

    /**
     * @param Request $request
     * @param AuthenticationException|null $authException
     *
     * @return Response
     */
    public function start(Request $request, AuthenticationException $authException = null): Response
    {
        return new RedirectResponse($this->router->generate('login'));
    }

    /**
     * @param Request $request
     *
     * @return AccessToken
     */
    public function getCredentials(Request $request): AccessToken
    {
        return $this->fetchAccessToken($this->githubClient);
    }

    /**
     * @param mixed $credentials
     * @param UserProviderInterface $userProvider
     *
     * @return UserInterface
     */
    public function getUser($credentials, UserProviderInterface $userProvider): UserInterface
    {
        $this->session->set(self::ACCESS_TOKEN, $credentials->getToken());

        $user = $this->githubClient->fetchUserFromToken($credentials)->getId();

        return $userProvider->loadUserByUsername($user);
    }

    /**
     * @param Request $request
     * @param AuthenticationException $exception
     *
     * @return Response
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): Response
    {
        $message = strtr($exception->getMessageKey(), $exception->getMessageData());

        return new Response($message, Response::HTTP_FORBIDDEN);
    }

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @param string $providerKey
     *
     * @return Response
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey): Response
    {
        return new RedirectResponse($this->router->generate('api_list'));
    }
}
