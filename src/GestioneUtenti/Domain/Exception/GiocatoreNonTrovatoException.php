<?php

namespace App\GestioneUtenti\Domain\Exception;

use App\Common\Domain\GestioneUtenti\Username;

class GiocatoreNonTrovatoException extends \DomainException
{
    public static function conUsername(Username $username): self
    {
        return new self(sprintf('Giocatore con username %s non trovato', $username->value()));
    }
}
