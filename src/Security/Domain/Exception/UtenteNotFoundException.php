<?php

namespace App\Security\Domain\Exception;

class UtenteNotFoundException extends \Exception
{
    public static function fromUsername(string $username): self
    {
        return new self('Utente non trovato ' . $username);
    }
}
