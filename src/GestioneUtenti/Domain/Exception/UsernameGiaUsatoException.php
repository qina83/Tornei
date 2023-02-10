<?php

namespace App\GestioneUtenti\Domain\Exception;

use App\Common\Domain\GestioneUtenti\Username;

class UsernameGiaUsatoException extends \DomainException
{
    public static function conValore(Username $username): self
    {
        return new self(sprintf('Username %s già usato', $username->value()));
    }
}
