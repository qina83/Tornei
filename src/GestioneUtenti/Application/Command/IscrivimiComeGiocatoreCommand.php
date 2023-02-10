<?php

namespace App\GestioneUtenti\Application\Command;

use App\Common\Application\TypeTrait;

final readonly class IscrivimiComeGiocatoreCommand
{
    use TypeTrait;

    private function __construct(
        public string $username,
        public string $nome,
        public string $cognome
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            self::getString($data, 'username'),
            self::getString($data, 'nome'),
            self::getString($data, 'cognome')
        );
    }
}
