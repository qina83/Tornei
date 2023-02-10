<?php

namespace App\GestioneTornei\Domain\Event;

use App\Common\Domain\Evento;
use App\GestioneTornei\Domain\IdTorneo;

class EventoTorneoDisattivato implements Evento
{
    public function __construct(
        private IdTorneo $idTorneo
    ) {
    }

    public function nome(): string
    {
        return 'TorneoDisattivato';
    }

    public function dati(): array
    {
        return [
            'id' => $this->idTorneo->stringValue(),
        ];
    }
}
