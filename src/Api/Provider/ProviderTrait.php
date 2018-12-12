<?php

declare(strict_types=1);

namespace App\Api\Provider;

trait ProviderTrait
{
    /** @var string */
    private $repositoryOwner;

    /** @var string */
    private $repositoryName;

    /**
     * @param string $repositoryOwner
     */
    public function setRepositoryOwner(string $repositoryOwner): void
    {
        $this->repositoryOwner = $repositoryOwner;
    }

    /**
     * @param string $repositoryName
     */
    public function setRepositoryName(string $repositoryName): void
    {
        $this->repositoryName = $repositoryName;
    }
}
