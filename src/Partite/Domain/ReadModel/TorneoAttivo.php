<?php

namespace App\Partite\Domain\ReadModel;

use App\Common\Domain\GestioneTornei\IdTorneo;

readonly final class TorneoAttivo
{
    public function __construct(
        public IdTorneo $id
    ) {
    }
}
