<?php

namespace App\Partite\Infrastructure;

use App\Common\Domain\GestioneUtenti\DatiAnagrafici;
use App\Common\Domain\GestioneUtenti\Username;
use App\Partite\Application\Query\GiocatoriAttiviQuery;
use App\Partite\Domain\GiocatoreAttivoRepository;
use App\Partite\Domain\ReadModel\GiocatoreAttivo;
use App\Partite\Domain\ViewModel\GiocatoreAttivi;
use App\Partite\Infrastructure\Entity\GiocatoreAttivoEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PostgreGiocatoreAttivoRepository extends ServiceEntityRepository implements GiocatoreAttivoRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GiocatoreAttivoEntity::class);
    }

    public function giocatoriAttivi(GiocatoriAttiviQuery $giocatoriAttiviQuery): GiocatoreAttivi
    {
        $giocatoreAttivi = new GiocatoreAttivi();
        $giocatoriAttiviEntity = $this->findAll();

        /* @var GiocatoreAttivoEntity $giocatoreAttivoEntity */
        foreach ($giocatoriAttiviEntity as $giocatoreAttivoEntity) {
            $giocatoreAttivi->append(
                new GiocatoreAttivo(
                    new Username($giocatoreAttivoEntity->username),
                    new DatiAnagrafici(
                        $giocatoreAttivoEntity->nome,
                        $giocatoreAttivoEntity->cognome
                    )
                )
            );
        }

        return $giocatoreAttivi;
    }

    public function aggiungiGiocatoreAttivo(GiocatoreAttivo $giocatoreAttivo)
    {
        $this->_em->persist(GiocatoreAttivoEntity::fromGiocatoreAttivo($giocatoreAttivo));
        $this->_em->flush();
    }

    public function rimuoviGiocatoreAttivo(Username $username)
    {
        $giocatoreAttivoEntity = $this->find($username->value());
        if (null !== $giocatoreAttivoEntity) {
            $this->_em->remove($giocatoreAttivoEntity);
            $this->_em->flush();
        }
    }
}
