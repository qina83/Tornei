<?php

namespace App\GestioneTornei\Domain\Event;

use App\Common\Domain\Evento;
use App\Common\Domain\GestioneTornei\IdTorneo;

readonly class EventoTorneoCreato implements Evento
{
    public function __construct(
        private IdTorneo $idTorneo
    ) {
    }

    public function nome(): string
    {
        return 'TorneoCreato';
    }

    public function dati(): array
    {
        return [
            'id' => $this->idTorneo->stringValue(),
        ];
    }
}
