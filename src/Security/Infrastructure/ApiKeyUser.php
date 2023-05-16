<?php

namespace App\Security\Infrastructure;

use Symfony\Component\Security\Core\User\UserInterface;

class ApiKeyUser implements UserInterface
{
    public function __construct(private string $apiKey)
    {
    }

    public function getRoles(): array
    {
        return [];
    }

    public function eraseCredentials()
    {

    }

    public function getUserIdentifier(): string
    {
        return $this->apiKey;
    }
}
