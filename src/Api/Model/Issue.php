<?php

declare(strict_types=1);

namespace App\Api\Model;

class Issue
{
    /** @var string */
    public const STATE_OPEN = 'open';

    /** @var string */
    public const STATE_CLOSED = 'closed';

    /** @var string|null */
    private $title;

    /** @var string|null */
    private $username;

    /** @var int|null */
    private $number;

    /** @var string|null */
    private $url;

    /** @var array */
    private $labels = [];

    /** @var array */
    private $comments = [];

    /** @var int */
    private $commentsCount = 0;

    /** @var string|null */
    private $state;

    /** @var \DateTime|null */
    private $createdAt;

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     *
     * @return Issue
     */
    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string|null $username
     *
     * @return Issue
     */
    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getNumber(): ?int
    {
        return $this->number;
    }

    /**
     * @param int|null $number
     *
     * @return Issue
     */
    public function setNumber(?int $number): self
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string|null $url
     *
     * @return Issue
     */
    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return array
     */
    public function getLabels(): array
    {
        return $this->labels;
    }

    /**
     * @param array $labels
     *
     * @return Issue
     */
    public function setLabels(array $labels): self
    {
        $this->labels = $labels;

        return $this;
    }

    /**
     * @return array
     */
    public function getComments(): array
    {
        return $this->comments;
    }

    /**
     * @param array $comments
     *
     * @return Issue
     */
    public function setComments(array $comments): self
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * @param string|null $state
     *
     * @return Issue
     */
    public function setState(?string $state): self
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime|null $createdAt
     *
     * @return Issue
     */
    public function setCreatedAt(?\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return int
     */
    public function getCommentsCount(): int
    {
        return $this->commentsCount;
    }

    /**
     * @param int $commentsCount
     *
     * @return Issue
     */
    public function setCommentsCount(int $commentsCount): self
    {
        $this->commentsCount = $commentsCount;

        return $this;
    }
}
