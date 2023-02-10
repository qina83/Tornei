<?php

namespace App\GestioneTornei\Domain;

use App\Common\Domain\GestioneTornei\IdTorneo;
use App\GestioneTornei\Domain\ViewModel\TorneiNonEliminati;

interface TorneoRepository
{
    public function salva(Torneo $torneo): void;

    public function carica(IdTorneo $id): Torneo;

    public function recuperaListaTorneiNonEliminati(): TorneiNonEliminati;
}
