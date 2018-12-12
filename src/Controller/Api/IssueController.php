<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Api\Provider\IssueProvider;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\Route;

/**
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
class IssueController extends FOSRestController
{
    /** @var IssueProvider */
    private $issueProvider;

    /**
     * @param IssueProvider $issueProvider
     */
    public function __construct(IssueProvider $issueProvider)
    {
        $this->issueProvider = $issueProvider;
    }

    /**
     * @Route("/issues/{repositoryOwner}/{repositoryName}/{page}", name="issue_list", methods={"GET"})
     *
     * @param string $repositoryOwner
     * @param string $repositoryName
     * @param int $page
     *
     * @return Response
     *
     * @throws \Exception
     */
    public function getIssues(string $repositoryOwner, string $repositoryName, int $page = 1): Response
    {
        $this->setRepository($repositoryOwner, $repositoryName);
        $view = $this->view($this->issueProvider->getIssueSummary($page), Response::HTTP_OK);

        return $this->handleView($view);
    }

    /**
     * @Route("/issue/{repositoryOwner}/{repositoryName}/{issueNumber}", name="issue", methods={"GET"})
     *
     * @param string $repositoryOwner
     * @param string $repositoryName
     * @param int $issueNumber
     *
     * @return Response
     *
     * @throws \Exception
     */
    public function getIssue(string $repositoryOwner, string $repositoryName, int $issueNumber): Response
    {
        $this->setRepository($repositoryOwner, $repositoryName);
        $view = $this->view($this->issueProvider->getIssue($issueNumber), Response::HTTP_OK);

        return $this->handleView($view);
    }

    /**
     * @param string $repositoryOwner
     * @param string $repositoryName
     */
    private function setRepository(string $repositoryOwner, string $repositoryName): void
    {
        $this->issueProvider->setRepositoryOwner($repositoryOwner);
        $this->issueProvider->setRepositoryName($repositoryName);
    }
}
