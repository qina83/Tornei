<?php

namespace App\GestioneTornei\Domain;

use App\GestioneTornei\Domain\ViewModel\ListaTorneiNonEliminati;

interface TorneoRepository
{
    public function salva(Torneo $torneo): void;

    public function carica(IdTorneo $id): Torneo;

    public function recuperaListaTorneiNonEliminati(): ListaTorneiNonEliminati;
}
