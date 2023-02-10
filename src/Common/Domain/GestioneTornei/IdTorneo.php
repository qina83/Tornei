<?php

namespace App\Common\Domain\GestioneTornei;

use Ramsey\Uuid\Rfc4122\UuidV4;
use Ramsey\Uuid\Uuid;

readonly class IdTorneo
{
    public function __construct(
        private string $id
    ) {
    }

    public static function fromString(string $id)
    {
        return new self(UuidV4::fromString($id)->toString());
    }

    public static function nuovo()
    {
        return new self(Uuid::uuid4()->toString());
    }

    public function stringValue(): string
    {
        return $this->id;
    }
}
