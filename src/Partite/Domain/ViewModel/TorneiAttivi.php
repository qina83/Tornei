<?php

namespace App\Partite\Domain\ViewModel;

use App\Partite\Domain\ReadModel\TorneoAttivo;

class TorneiAttivi extends \ArrayIterator
{
    public function toArray(): array
    {
        return array_map(function (TorneoAttivo $torneoAttivo) {
            return [
                'id' => $torneoAttivo->id->stringValue(),
            ];
        }, $this->getArrayCopy());
    }
}
