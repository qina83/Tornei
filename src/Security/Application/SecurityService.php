<?php

namespace App\Security\Application;

use App\Security\Domain\AuthToken;
use App\Security\Domain\Exception\CredenzialiErrateException;
use App\Security\Domain\Utente;
use App\Security\Domain\UtenteRepository;

class SecurityService implements Security
{

    public function __construct(
        private UtenteRepository $utenteRepository,
        private AuthToken $authToken
    )
    {
    }

    public function login(string $username, string $password): string
    {
        $utente = $this->utenteRepository->caricaUtente($username);
        if (!password_verify($password, $utente->getPassword())){
            throw new CredenzialiErrateException();
        }

        return $this->authToken->fromUtente($utente);
    }

    public function encodePassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT, ['cost' => 9]);
    }

    public function authenticate()
    {
        // TODO: Implement authenticate() method.
    }
}
