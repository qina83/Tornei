<?php

namespace App\GestioneUtenti\Application;

use App\GestioneUtenti\Application\Command\DisattivaUnAccountGiocatoreCommand;
use App\GestioneUtenti\Application\Command\IscrivimiComeGiocatoreCommand;

interface GestioneUtenti
{
    public function iscrivimiComeGiocatore(IscrivimiComeGiocatoreCommand $command): void;

    public function disattivaUnAccountGiocatore(DisattivaUnAccountGiocatoreCommand $command): void;
}
