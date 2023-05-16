<?php

namespace App\Security\Infrastructure;

use Symfony\Component\Security\Core\User\UserInterface;

class ApiKeyUserLoader
{
    public function __invoke(string $apiKey): ?UserInterface
    {
        if ($apiKey === 'apiKeyTest'){
            return new ApiKeyUser($apiKey);
        }

        return null;
    }
}
