<?php

namespace App\GestioneUtenti\Application\Command;

use App\Common\Application\TypeTrait;

class DisattivaUnAccountGiocatoreCommand
{
    use TypeTrait;

    private function __construct(
        public string $username
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            self::getString($data, 'username')
        );
    }
}
