<?php

namespace App\GestioneTornei\Application;

use App\Common\Application\EventBus;
use App\Common\Domain\GestioneTornei\IdTorneo;
use App\GestioneTornei\Application\Command\AttivaTorneoCommand;
use App\GestioneTornei\Application\Command\CreaNuovoTorneoCommand;
use App\GestioneTornei\Application\Command\DisattivaTorneoCommand;
use App\GestioneTornei\Application\Query\TorneiNonEliminatiQuery;
use App\GestioneTornei\Domain\Torneo;
use App\GestioneTornei\Domain\TorneoRepository;
use App\GestioneTornei\Domain\ViewModel\TorneiNonEliminati;

class GestioneTorneiService implements GestioneTornei
{
    public function __construct(
        private TorneoRepository $torneoRepository,
        private EventBus $eventBus
    ) {
    }

    public function creaUnNuovoTorneo(CreaNuovoTorneoCommand $command): void
    {
        $torneo = Torneo::nuovo();
        $this->torneoRepository->salva($torneo);

        $this->dispatchEventi($torneo);
    }

    private function dispatchEventi(Torneo $torneo): void
    {
        $this->eventBus->dispatchAll($torneo->eventi());
    }

    public function recuperaListaTorneiNonEliminati(TorneiNonEliminatiQuery $listaTorneiNonEliminatiQuery): TorneiNonEliminati
    {
        return $this->torneoRepository->recuperaListaTorneiNonEliminati();
    }

    public function attivaUnTorneo(AttivaTorneoCommand $command): void
    {
        $torneo = $this->torneoRepository->carica(IdTorneo::fromString($command->id));
        $torneo->attiva();
        $this->torneoRepository->salva($torneo);
        $this->dispatchEventi($torneo);
    }

    public function disattivaUnTorneo(DisattivaTorneoCommand $command): void
    {
        $torneo = $this->torneoRepository->carica(IdTorneo::fromString($command->id));
        $torneo->disattiva();
        $this->torneoRepository->salva($torneo);
        $this->dispatchEventi($torneo);
    }
}
