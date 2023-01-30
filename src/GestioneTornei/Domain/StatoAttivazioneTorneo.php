<?php

namespace App\GestioneTornei\Domain;



class StatoAttivazioneTorneo
{
    private const TORNEO_ATTIVATO = 'attivato';
    private const TORNEO_DISATTIVATO = 'disattivato';


    private function __construct(
        private string $stato
    )
    {
        if (!in_array($stato, [self::TORNEO_ATTIVATO, self::TORNEO_DISATTIVATO])){
            throw new \Exception('Stato non riconosciuto');
        }
    }

    public static function attivato(): self
    {
        return new self(self::TORNEO_ATTIVATO);
    }

    public static function disattivato(): self
    {
        return new self(self::TORNEO_DISATTIVATO);
    }

    public function stringValue(): string
    {
        return $this->stato;
    }

    public function eAttivato(): bool
    {
        return $this->stato === self::TORNEO_ATTIVATO;
    }

    public function eDisattivato(): bool
    {
        return $this->stato === self::TORNEO_DISATTIVATO;
    }
    public static function fromString(string $value): self
    {
        return new self($value);
    }




}
