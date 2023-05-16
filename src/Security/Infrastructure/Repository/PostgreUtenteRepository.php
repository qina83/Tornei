<?php

namespace App\Security\Infrastructure\Repository;

use App\GestioneUtenti\Infrastructure\Entity\GiocatoreStateEntity;
use App\Security\Domain\Utente;
use App\Security\Domain\UtenteRepository;
use App\Security\Infrastructure\Entity\UtenteStateEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PostgreUtenteRepository extends ServiceEntityRepository implements UtenteRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UtenteStateEntity::class);
    }

    public function aggiungiUtente(Utente $utente)
    {
        $state = $this->find($utente->toArray()['username']);
        if (null === $state) {
            $state = new UtenteStateEntity();
        }

        $state->updateFromArray($utente->toArray());

        $this->_em->persist($state);
        $this->_em->flush();
    }

    public function rimuoviUtente(string $username)
    {
        $state = $this->find($username);
        if (null !== $state) {
            $this->_em->remove($state);
        }
    }
}
