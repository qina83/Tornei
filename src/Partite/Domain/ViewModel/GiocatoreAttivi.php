<?php

namespace App\Partite\Domain\ViewModel;

use App\Partite\Domain\ReadModel\GiocatoreAttivo;

class GiocatoreAttivi extends \ArrayIterator
{
    public function toArray(): array
    {
        return array_map(function (GiocatoreAttivo $giocatoreAttivo) {
            return [
                'username' => $giocatoreAttivo->username->value(),
                'nome' => $giocatoreAttivo->datiAnagrafici->nome(),
                'cognome' => $giocatoreAttivo->datiAnagrafici->cognome(),
            ];
        }, $this->getArrayCopy());
    }
}
