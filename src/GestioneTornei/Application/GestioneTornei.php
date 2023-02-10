<?php

namespace App\GestioneTornei\Application;

use App\GestioneTornei\Application\Command\AttivaTorneoCommand;
use App\GestioneTornei\Application\Command\CreaNuovoTorneoCommand;
use App\GestioneTornei\Application\Command\DisattivaTorneoCommand;
use App\GestioneTornei\Application\Query\TorneiNonEliminatiQuery;
use App\GestioneTornei\Domain\ViewModel\TorneiNonEliminati;

interface GestioneTornei
{
    public function creaUnNuovoTorneo(CreaNuovoTorneoCommand $command): void;

    public function attivaUnTorneo(AttivaTorneoCommand $command): void;

    public function disattivaUnTorneo(DisattivaTorneoCommand $command): void;

    public function recuperaListaTorneiNonEliminati(TorneiNonEliminatiQuery $listaTorneiNonEliminatiQuery): TorneiNonEliminati;
}
