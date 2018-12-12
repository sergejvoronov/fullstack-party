<?php

declare(strict_types=1);

namespace App\Service;

use App\Security\GithubAuthenticator;
use Github\Client as ApiClient;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class GithubApi
{
    /** @var ApiClient */
    private $apiClient;

    /** @var SessionInterface */
    private $session;

    /**
     * @param ApiClient $apiClient
     * @param SessionInterface $session
     */
    public function __construct(
        ApiClient $apiClient,
        SessionInterface $session
    ) {
        $this->apiClient = $apiClient;
        $this->session = $session;
        $this->authenticateApiClient();
    }

    /**
     * @return ApiClient
     */
    public function api(): ApiClient
    {
        return $this->apiClient;
    }

    /**
     * @return void
     */
    private function authenticateApiClient(): void
    {
        $this->apiClient->authenticate($this->getAccessToken(), ApiClient::AUTH_HTTP_TOKEN);
    }

    /**
     * @return string
     */
    private function getAccessToken(): string
    {
        return $this->session->get(GithubAuthenticator::ACCESS_TOKEN);
    }
}
