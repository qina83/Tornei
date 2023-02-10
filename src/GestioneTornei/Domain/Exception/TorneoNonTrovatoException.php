<?php

namespace App\GestioneTornei\Domain\Exception;

use App\Common\Domain\GestioneTornei\IdTorneo;

class TorneoNonTrovatoException extends \DomainException
{
    public static function conId(IdTorneo $id): self
    {
        return new self(sprintf('Torneo con id %s non trovato', $id->stringValue()));
    }
}
