<?php

namespace App\Partite\Application;

use App\Partite\Application\Query\GiocatoriAttiviQuery;
use App\Partite\Application\Query\TorneiAttiviQuery;
use App\Partite\Domain\GiocatoreAttivoRepository;
use App\Partite\Domain\TorneoAttivoRepository;
use App\Partite\Domain\ViewModel\GiocatoreAttivi;
use App\Partite\Domain\ViewModel\TorneiAttivi;

class PartiteService implements Partite
{
    public function __construct(
       private TorneoAttivoRepository $torneoAttivoRepository,
       private GiocatoreAttivoRepository $giocatoreAttivoRepository,
    ) {
    }

    public function listaTorneiAttivi(TorneiAttiviQuery $torneiAttiviQuery): TorneiAttivi
    {
        return $this->torneoAttivoRepository->listaTorneiAttivi($torneiAttiviQuery);
    }

    public function listaGiocatoriAttivi(GiocatoriAttiviQuery $giocatoriAttiviQuery): GiocatoreAttivi
    {
        return $this->giocatoreAttivoRepository->giocatoriAttivi($giocatoriAttiviQuery);
    }
}
