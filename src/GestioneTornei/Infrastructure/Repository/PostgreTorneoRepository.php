<?php

namespace App\GestioneTornei\Infrastructure\Repository;

use App\Common\Domain\GestioneTornei\IdTorneo;
use App\GestioneTornei\Domain\Exception\TorneoNonTrovatoException;
use App\GestioneTornei\Domain\StatoAttivazioneTorneo;
use App\GestioneTornei\Domain\Torneo;
use App\GestioneTornei\Domain\TorneoRepository;
use App\GestioneTornei\Domain\ViewModel\TorneiNonEliminati;
use App\GestioneTornei\Domain\ViewModel\TorneoNonEliminato;
use App\GestioneTornei\Infrastructure\Entity\TorneoStateEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PostgreTorneoRepository extends ServiceEntityRepository implements TorneoRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TorneoStateEntity::class);
    }

    public function salva(Torneo $torneo): void
    {
        $state = $this->find($torneo->toArray()['id']);
        if (null === $state) {
            $state = new TorneoStateEntity();
        }

        $state->updateFromArray($torneo->toArray());

        $this->_em->persist($state);
        $this->_em->flush();
    }

    public function recuperaListaTorneiNonEliminati(): TorneiNonEliminati
    {
        /** @var TorneoStateEntity $states */
        $states = $this->findAll();
        $lista = new TorneiNonEliminati();

        /** @var TorneoStateEntity $state */
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

        if (empty($state)) {
            throw TorneoNonTrovatoException::conId($id);
        }

        return Torneo::fromArray($state->toArray());
    }
}
