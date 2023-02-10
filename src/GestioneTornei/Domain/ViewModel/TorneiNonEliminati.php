<?php

namespace App\GestioneTornei\Domain\ViewModel;

final class TorneiNonEliminati extends \ArrayIterator
{
    public function toArray(): array
    {
        return array_map(function (TorneoNonEliminato $torneoNonEliminato) {return $torneoNonEliminato->toArray(); }, $this->getArrayCopy());
    }
}
