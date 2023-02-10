<?php

namespace App\GestioneTornei\Application;

use App\Common\Application\EventBus;
use App\Common\Domain\Eventi;
use App\GestioneTornei\Application\Command\AttivaTorneoCommand;
use App\GestioneTornei\Application\Command\CreaNuovoTorneoCommand;
use App\GestioneTornei\Application\Command\DisattivaTorneoCommand;
use App\GestioneTornei\Application\Query\ListaTorneiNonEliminatiQuery;
use App\GestioneTornei\Domain\IdTorneo;
use App\GestioneTornei\Domain\Torneo;
use App\GestioneTornei\Domain\TorneoRepository;
use App\GestioneTornei\Domain\ViewModel\ListaTorneiNonEliminati;

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

        $eventi = $torneo->eventi();
        $this->dispatchEventi($eventi);
    }

    private function dispatchEventi(Eventi $eventi): void
    {
        $this->eventBus->dispatchAll($eventi);
    }

    public function recuperaListaTorneiNonEliminati(ListaTorneiNonEliminatiQuery $listaTorneiNonEliminatiQuery): ListaTorneiNonEliminati
    {
        return $this->torneoRepository->recuperaListaTorneiNonEliminati();
    }

    public function attivaUnTorneo(AttivaTorneoCommand $command): void
    {
       $torneo = $this->torneoRepository->carica(IdTorneo::fromString($command->id));
       $torneo->attiva();;
       $this->torneoRepository->salva($torneo);
    }

    public function disattivaUnTorneo(DisattivaTorneoCommand $command): void
    {
        $torneo = $this->torneoRepository->carica(IdTorneo::fromString($command->id));
        $torneo->disattiva();
        $this->torneoRepository->salva($torneo);
    }
}
