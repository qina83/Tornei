<?php

namespace App\GestioneTornei\Application\Command;

use App\Common\Application\TypeTrait;

readonly final class DisattivaTorneoCommand
{
    use TypeTrait;

    public function __construct(
        public string $id
    ) {
    }

    public static function fromData(array $data): self
    {
        return new self(
            self::getString($data, 'id')
        );
    }
}
