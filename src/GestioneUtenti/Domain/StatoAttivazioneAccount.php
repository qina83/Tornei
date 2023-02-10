<?php

namespace App\GestioneUtenti\Domain;

final readonly class StatoAttivazioneAccount
{
    private function __construct(
        private bool $attivo
    ) {
    }

    public function eAttivo(): bool
    {
        return $this->attivo;
    }

    public static function attivo(): self
    {
        return new self(true);
    }

    public static function disattivo(): self
    {
        return new self(false);
    }

    public static function fromValue(bool $attivo)
    {
        return new self($attivo);
    }

    public function value(): bool
    {
        return $this->attivo;
    }
}
