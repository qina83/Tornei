<?php

namespace App\GestioneTornei\Domain\ViewModel;

use App\Common\Domain\GestioneTornei\IdTorneo;
use App\GestioneTornei\Domain\StatoAttivazioneTorneo;

final readonly class TorneoNonEliminato
{
    public function __construct(
        public IdTorneo $id,
        public StatoAttivazioneTorneo $statoAttivazioneTorneo
    ) {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id->stringValue(),
            'attivo' => $this->statoAttivazioneTorneo->eAttivato(),
        ];
    }
}
