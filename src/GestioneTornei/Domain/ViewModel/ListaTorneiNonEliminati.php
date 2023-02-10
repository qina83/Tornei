<?php

namespace App\GestioneTornei\Domain\ViewModel;

final class ListaTorneiNonEliminati extends \ArrayIterator
{
    public function toArray(): array
    {
        return array_map(function(TorneoNonEliminato $torneoNonEliminato){return $torneoNonEliminato->toArray(); }, $this->getArrayCopy());
    }
}
