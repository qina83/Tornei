<?php

namespace App\GestioneUtenti\Infrastructure\Repository;

use App\Common\Domain\GestioneUtenti\Username;
use App\GestioneUtenti\Domain\Exception\GiocatoreNonTrovatoException;
use App\GestioneUtenti\Domain\Giocatore;
use App\GestioneUtenti\Domain\GiocatoreRepository;
use App\GestioneUtenti\Infrastructure\Entity\GiocatoreStateEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PostgreGiocatoreRepository extends ServiceEntityRepository implements GiocatoreRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GiocatoreStateEntity::class);
    }

    public function salva(Giocatore $giocatore): void
    {
        $state = $this->find($giocatore->toArray()['username']);
        if (null === $state) {
            $state = new GiocatoreStateEntity();
        }

        $state->updateFromArray($giocatore->toArray());

        $this->_em->persist($state);
        $this->_em->flush();
    }

    public function esisteGiocatoreConStessoUsername(Username $username): bool
    {
        return null !== $this->find($username->value());
    }

    public function carica(Username $username): Giocatore
    {
        $state = $this->find($username->value());
        if (null === $state) {
            throw GiocatoreNonTrovatoException::conUsername($username);
        }

        return Giocatore::fromArray($state->toArray());
    }
}
