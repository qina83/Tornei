<?php

namespace App\GestioneTornei\Domain;

use App\Common\Domain\Eventi;
use App\Common\Domain\GestioneTornei\IdTorneo;
use App\GestioneTornei\Domain\Event\EventoTorneoAttivato;
use App\GestioneTornei\Domain\Event\EventoTorneoCreato;
use App\GestioneTornei\Domain\Event\EventoTorneoDisattivato;

final class Torneo
{
    private Eventi $eventi;

    private function __construct(
        private IdTorneo $id,
        private StatoAttivazioneTorneo $statoAttivazioneTorneo
    ) {
        $this->eventi = new Eventi();
    }

    public static function nuovo(): self
    {
        $self = new self(
            IdTorneo::nuovo(),
            StatoAttivazioneTorneo::disattivato()
        );

        $evento = new EventoTorneoCreato($self->id);
        $self->eventi->append($evento);

        return $self;
    }

    public function attiva()
    {
        if ($this->statoAttivazioneTorneo->eDisattivato()) {
            $this->statoAttivazioneTorneo = StatoAttivazioneTorneo::attivato();
            $evento = new EventoTorneoAttivato($this->id);
            $this->eventi->append($evento);
        }
    }

    public function disattiva()
    {
        if ($this->statoAttivazioneTorneo->eAttivato()) {
            $this->statoAttivazioneTorneo = StatoAttivazioneTorneo::disattivato();
            $evento = new EventoTorneoDisattivato($this->id);
            $this->eventi->append($evento);
        }
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id->stringValue(),
            'statoAttivazione' => $this->statoAttivazioneTorneo->stringValue(),
        ];
    }

    public static function fromArray(array $state): self
    {
        return new self(
            IdTorneo::fromString($state['id']),
            StatoAttivazioneTorneo::fromString($state['statoAttivazione'])
        );
    }

    public function eventi(): Eventi
    {
        return $this->eventi;
    }
}
