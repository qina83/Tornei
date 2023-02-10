<?php

namespace App\GestioneUtenti\Domain\Event;

use App\Common\Domain\Evento;
use App\Common\Domain\GestioneUtenti\Username;

final readonly class EventoGiocatoreDisattivato implements Evento
{
    public function __construct(
        private Username $username
    ) {
    }

    public function nome(): string
    {
        return 'GiocatoreDisattivato';
    }

    public function dati(): array
    {
        return [
            'username' => $this->username->value(),
        ];
    }
}
