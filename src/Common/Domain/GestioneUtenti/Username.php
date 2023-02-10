<?php

namespace App\Common\Domain\GestioneUtenti;

use Webmozart\Assert\Assert;

readonly final class Username
{
    public function __construct(
        private string $username
    ) {
        Assert::email($username);
    }

    public function value(): string
    {
        return $this->username;
    }
}
