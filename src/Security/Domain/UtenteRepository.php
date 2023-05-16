<?php

namespace App\Security\Domain;

interface UtenteRepository
{
    public function aggiungiUtente(Utente $utente): void;

    public function rimuoviUtente(string $username): void;

    public function caricaUtente(string $username): Utente;
}
