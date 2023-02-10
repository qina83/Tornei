<?php

namespace App\GestioneTornei\Infrastructure\Repository;

use App\GestioneTornei\Domain\IdTorneo;
use App\GestioneTornei\Domain\StatoAttivazioneTorneo;
use App\GestioneTornei\Domain\Torneo;
use App\GestioneTornei\Domain\TorneoRepository;
use App\GestioneTornei\Domain\ViewModel\ListaTorneiNonEliminati;
use App\GestioneTornei\Domain\ViewModel\TorneoNonEliminato;
use App\GestioneTornei\Infrastructure\Entity\TorneoState;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PostgreTorneoRepository extends ServiceEntityRepository implements TorneoRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TorneoState::class);
    }

    public function salva(Torneo $torneo): void
    {
        $state = $this->find($torneo->toArray()['id']);
        if ($state === null) {
            $state = new TorneoState();
        }

        $state->updateFromArray($torneo->toArray());


        $this->_em->persist($state);
        $this->_em->flush();
    }

    public function recuperaListaTorneiNonEliminati(): ListaTorneiNonEliminati
    {
        /** @var TorneoState $states */
        $states = $this->findAll();
        $lista = new ListaTorneiNonEliminati();

        /** @var TorneoState $state */
        foreach ($states as $state) {
            $lista->append(new TorneoNonEliminato(
                IdTorneo::fromString($state->id),
                StatoAttivazioneTorneo::fromString($state->statoAttivazione)
            ));
        }

        return $lista;
    }

    public function carica(IdTorneo $id): Torneo
    {
        $state = $this->find($id->stringValue());
        return Torneo::fromArray($state->toArray());
    }
}
