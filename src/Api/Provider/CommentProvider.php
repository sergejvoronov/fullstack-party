<?php

declare(strict_types=1);

namespace App\Api\Provider;

use App\Api\Factory\CommentFactory;
use App\Service\GithubApi;
use Github\Client as ApiClient;

class CommentProvider
{
    use ProviderTrait;

    /** @var ApiClient */
    private $githubApi;

    /**
     * @param GithubApi $githubApi
     */
    public function __construct(GithubApi $githubApi)
    {
        $this->githubApi = $githubApi->api();
    }

    /**
     * @param int $issueNumber
     *
     * @return array
     *
     * @throws \Exception
     */
    public function getComments(int $issueNumber): array
    {
        $populatedComments = [];
        $comments = $this->githubApi->issues()->comments()->all(
            $this->repositoryOwner,
            $this->repositoryName,
            $issueNumber
        );

        foreach ($comments as $comment) {
            $populatedComments[] = CommentFactory::create($comment);
        }

        return $populatedComments;
    }
}
