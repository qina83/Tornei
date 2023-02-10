<?php

namespace App\Partite\Application;

use App\Partite\Application\Query\GiocatoriAttiviQuery;
use App\Partite\Application\Query\TorneiAttiviQuery;
use App\Partite\Domain\ViewModel\GiocatoreAttivi;
use App\Partite\Domain\ViewModel\TorneiAttivi;

interface Partite
{
    public function listaTorneiAttivi(TorneiAttiviQuery $torneiAttiviQuery): TorneiAttivi;

    public function listaGiocatoriAttivi(GiocatoriAttiviQuery $giocatoriAttiviQuery): GiocatoreAttivi;
}
