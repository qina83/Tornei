<?php

namespace App\Partite\Domain;

use App\Common\Domain\GestioneUtenti\Username;
use App\Partite\Application\Query\GiocatoriAttiviQuery;
use App\Partite\Domain\ReadModel\GiocatoreAttivo;
use App\Partite\Domain\ViewModel\GiocatoreAttivi;

interface GiocatoreAttivoRepository
{
    public function giocatoriAttivi(GiocatoriAttiviQuery $giocatoriAttiviQuery): GiocatoreAttivi;

    public function aggiungiGiocatoreAttivo(GiocatoreAttivo $giocatoreAttivo);

    public function rimuoviGiocatoreAttivo(Username $username);
}
