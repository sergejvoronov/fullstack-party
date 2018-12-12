<?php

declare(strict_types=1);

namespace App\Api\Factory;

use App\Api\Model\Issue;

class IssueFactory
{
    /**
     * @param array $fetchedIssue
     * @param array $comments
     *
     * @return Issue
     *
     * @throws \Exception
     */
    public static function create(array $fetchedIssue, array $comments): Issue
    {
        $issue = new Issue();
        $issue
            ->setTitle($fetchedIssue['title'])
            ->setUsername($fetchedIssue['user']['login'])
            ->setNumber($fetchedIssue['number'])
            ->setUrl($fetchedIssue['url'])
            ->setLabels($fetchedIssue['labels'])
            ->setState($fetchedIssue['state'])
            ->setComments($comments)
            ->setCommentsCount(count($comments))
            ->setCreatedAt(new \DateTime($fetchedIssue['created_at']))
        ;

        return $issue;
    }


}
