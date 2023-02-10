<?php

namespace App\Partite\Domain;

use App\Partite\Application\Query\TorneiAttiviQuery;
use App\Partite\Domain\ReadModel\TorneoAttivo;
use App\Partite\Domain\ViewModel\TorneiAttivi;

interface TorneoAttivoRepository
{
    public function listaTorneiAttivi(TorneiAttiviQuery $torneiAttiviQuery): TorneiAttivi;

    public function aggiungiTorneoAttivo(TorneoAttivo $torneoAttivo);

    public function rimuoviTorneoAttivo(TorneoAttivo $torneoAttivo);
}
