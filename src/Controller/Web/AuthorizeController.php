<?php

declare(strict_types=1);

namespace App\Controller\Web;

use KnpU\OAuth2ClientBundle\Client\Provider\GithubClient;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AuthorizeController
{
    /**
     * @Route("/authorize", name="authorize", methods={"GET"})
     *
     * @param GithubClient $githubClient
     *
     * @return RedirectResponse
     */
    public function authorize(GithubClient $githubClient): RedirectResponse
    {
        return $githubClient->redirect(
            [
                'user:email',
                'public_repo',
            ]
        );
    }

    /**
     * @Route("/authorize/check", name="authorization_check", methods={"GET"})
     *
     * @param Request $request
     * @param ClientRegistry $clientRegistry
     */
    public function checkAuthorization(Request $request, ClientRegistry $clientRegistry): void
    {
    }
}
