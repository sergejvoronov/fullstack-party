<?php

declare(strict_types=1);

namespace App\Api\Factory;

use App\Api\Model\Comment;

class CommentFactory
{
    /**
     * @param array $fetchedComment
     *
     * @return Comment
     *
     * @throws \Exception
     */
    public static function create(array $fetchedComment): Comment
    {
        $issue = new Comment();
        $issue
            ->setUsername($fetchedComment['user']['login'])
            ->setAvatar($fetchedComment['user']['avatar_url'])
            ->setBody($fetchedComment['body'])
            ->setCreatedAt(new \DateTime($fetchedComment['created_at']))
        ;

        return $issue;
    }
}
