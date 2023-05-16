<?php

namespace App\Security\Domain;

interface AuthToken
{
    public function fromUtente(Utente $utente): string;
}
