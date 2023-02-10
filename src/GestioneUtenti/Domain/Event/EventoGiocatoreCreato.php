<?php

namespace App\GestioneUtenti\Domain\Event;

use App\Common\Domain\Evento;
use App\Common\Domain\GestioneUtenti\DatiAnagrafici;
use App\Common\Domain\GestioneUtenti\Username;

final readonly class EventoGiocatoreCreato implements Evento
{
    public function __construct(
        private Username $username,
        private DatiAnagrafici $datiAnagrafici
    ) {
    }

    public function nome(): string
    {
        return 'GiocatoreCreato';
    }

    public function dati(): array
    {
        return [
            'username' => $this->username->value(),
            'nome' => $this->datiAnagrafici->nome(),
            'cognome' => $this->datiAnagrafici->cognome(),
        ];
    }
}
