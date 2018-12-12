<?php

declare(strict_types=1);

namespace App\Api\Provider;

use App\Api\Factory\IssueFactory;
use App\Api\Model\Issue;
use App\Service\GithubApi;
use Github\Client as ApiClient;

class IssueProvider
{
    use ProviderTrait;

    /** @var int */
    public const ISSUES_PER_PAGE = 4;

    /** @var ApiClient */
    private $githubApi;

    /** @var CommentProvider */
    private $commentProvider;

    /**
     * @param GithubApi $githubApi
     * @param CommentProvider $commentProvider
     */
    public function __construct(GithubApi $githubApi, CommentProvider $commentProvider)
    {
        $this->githubApi = $githubApi->api();
        $this->commentProvider = $commentProvider;
    }

    /**
     * @param int $page
     *
     * @return array
     *
     * @throws \Exception
     */
    public function getIssueSummary(int $page): array
    {
        $summary['openIssues'] = $this->countIssuesByState(Issue::STATE_OPEN);
        $summary['closedIssues'] = $this->countIssuesByState(Issue::STATE_CLOSED);
        $summary['issues'] = $this->getIssues($page);

        return $summary;
    }

    /**
     * @param string $state
     *
     * @return int
     */
    private function countIssuesByState(string $state): int
    {
        return $this->githubApi->search()->issues(
            sprintf(
                'repo:%s/%s type:issue state:%s',
                $this->repositoryOwner,
                $this->repositoryName,
                $state
            )
        )['total_count'];
    }

    /**
     * @param int $page
     *
     * @return array
     *
     * @throws \Exception
     */
    public function getIssues(int $page): array
    {
        $populatedIssues = [];
        $this->setCommentRepository($this->repositoryOwner, $this->repositoryName);

        $issues = $this->githubApi->issues()->all(
            $this->repositoryOwner,
            $this->repositoryName,
            [
                'per_page' => self::ISSUES_PER_PAGE,
                'page' => $page,
            ]
        );

        foreach ($issues as $issue) {
            $createdIssue = IssueFactory::create($issue, $this->commentProvider->getComments($issue['number']));

            $populatedIssues[] = $createdIssue;
        }

        return $populatedIssues;
    }

    /**
     * @param int $number
     *
     * @return Issue
     *
     * @throws \Exception
     */
    public function getIssue(int $number): Issue
    {
        $this->setCommentRepository($this->repositoryOwner, $this->repositoryName);
        $issue = $this->githubApi->issue()->show($this->repositoryOwner, $this->repositoryName, $number);

        return IssueFactory::create($issue, $this->commentProvider->getComments($issue['number']));
    }

    /**
     * @param string $repositoryOwner
     * @param string $repositoryName
     */
    private function setCommentRepository(string $repositoryOwner, string $repositoryName): void
    {
        $this->commentProvider->setRepositoryOwner($repositoryOwner);
        $this->commentProvider->setRepositoryName($repositoryName);
    }
}
