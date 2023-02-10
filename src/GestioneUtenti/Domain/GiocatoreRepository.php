<?php

namespace App\GestioneUtenti\Domain;

use App\Common\Domain\GestioneUtenti\Username;

interface GiocatoreRepository
{
    public function salva(Giocatore $giocatore): void;

    public function carica(Username $username): Giocatore;

    public function esisteGiocatoreConStessoUsername(Username $username): bool;
}
