<?php

namespace App\Partite\Infrastructure;

use App\Common\Domain\GestioneTornei\IdTorneo;
use App\Partite\Application\Query\TorneiAttiviQuery;
use App\Partite\Domain\ReadModel\TorneoAttivo;
use App\Partite\Domain\TorneoAttivoRepository;
use App\Partite\Domain\ViewModel\TorneiAttivi;
use App\Partite\Infrastructure\Entity\TorneoAttivoEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PostgreTorneoAttivoRepository extends ServiceEntityRepository implements TorneoAttivoRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TorneoAttivoEntity::class);
    }

    public function listaTorneiAttivi(TorneiAttiviQuery $torneiAttiviQuery): TorneiAttivi
    {
        $torneiAttivi = new TorneiAttivi();
        $torneiAttiviEntity = $this->findAll();

        /* @var TorneoAttivoEntity $torneoAttivo */
        foreach ($torneiAttiviEntity as $torneoAttivoEntity) {
            $torneiAttivi->append(
                new TorneoAttivo(
                    IdTorneo::fromString($torneoAttivoEntity->id)
                )
            );
        }

        return $torneiAttivi;
    }

    public function aggiungiTorneoAttivo(TorneoAttivo $torneoAttivo)
    {
        $this->_em->persist(TorneoAttivoEntity::fromTorneoAttivo($torneoAttivo));
        $this->_em->flush();
    }

    public function rimuoviTorneoAttivo(TorneoAttivo $torneoAttivo)
    {
        $torneoAttivoEntity = $this->find($torneoAttivo->id->stringValue());
        if (null !== $torneoAttivoEntity) {
            $this->_em->remove($torneoAttivoEntity);
            $this->_em->flush();
        }
    }
}
