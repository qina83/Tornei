<?php

namespace App\Security\Application;

use App\Security\Domain\Utente;

interface Security
{
    public function login(string $username, string $password): string;

    public function encodePassword(string $password): string;

    public function authenticate();
}
