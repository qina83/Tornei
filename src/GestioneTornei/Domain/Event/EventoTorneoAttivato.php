<?php

namespace App\GestioneTornei\Domain\Event;

use App\Common\Domain\Evento;
use App\GestioneTornei\Domain\IdTorneo;

class EventoTorneoAttivato implements Evento
{
    public function __construct(
        private IdTorneo $idTorneo
    ) {
    }

    public function nome(): string
    {
        return 'TorneoAttivato';
    }

    public function dati(): array
    {
        return [
            'id' => $this->idTorneo->stringValue(),
        ];
    }
}
