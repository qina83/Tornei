<?php

namespace App\Security\Domain;

interface UtenteRepository
{
    public function aggiungiUtente(Utente $utente);

    public function rimuoviUtente(string $username);
}
