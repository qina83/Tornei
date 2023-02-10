<?php

namespace App\Partite\Domain\ReadModel;

use App\Common\Domain\GestioneUtenti\DatiAnagrafici;
use App\Common\Domain\GestioneUtenti\Username;

final readonly class GiocatoreAttivo
{
    public function __construct(
        public Username $username,
        public DatiAnagrafici $datiAnagrafici
    ) {
    }
}
