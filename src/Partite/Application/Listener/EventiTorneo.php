<?php

namespace App\Partite\Application\Listener;

use App\Common\Domain\Evento;
use App\Common\Domain\GestioneTornei\IdTorneo;
use App\Partite\Domain\ReadModel\TorneoAttivo;
use App\Partite\Domain\TorneoAttivoRepository;

class EventiTorneo
{
    public function __construct(
       private TorneoAttivoRepository $repository
    ) {
    }

    public function whenTorneoAttivato(Evento $evento)
    {
        $torneoAttivo = new TorneoAttivo(IdTorneo::fromString($evento->dati()['id']));
        $this->repository->aggiungiTorneoAttivo($torneoAttivo);
    }

    public function whenTorneoDisattivato(Evento $evento)
    {
        $torneoAttivo = new TorneoAttivo(IdTorneo::fromString($evento->dati()['id']));
        $this->repository->rimuoviTorneoAttivo($torneoAttivo);
    }
}
