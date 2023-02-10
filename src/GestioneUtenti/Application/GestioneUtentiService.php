<?php

namespace App\GestioneUtenti\Application;

use App\Common\Application\EventBus;
use App\Common\Domain\GestioneUtenti\DatiAnagrafici;
use App\Common\Domain\GestioneUtenti\Username;
use App\GestioneUtenti\Application\Command\DisattivaUnAccountGiocatoreCommand;
use App\GestioneUtenti\Application\Command\IscrivimiComeGiocatoreCommand;
use App\GestioneUtenti\Domain\Exception\UsernameGiaUsatoException;
use App\GestioneUtenti\Domain\Giocatore;
use App\GestioneUtenti\Domain\GiocatoreRepository;

class GestioneUtentiService implements GestioneUtenti
{
    public function __construct(
        private GiocatoreRepository $repository,
        private EventBus $eventBus
    ) {
    }

    public function iscrivimiComeGiocatore(IscrivimiComeGiocatoreCommand $command): void
    {
        $username = new Username($command->username);

        if ($this->repository->esisteGiocatoreConStessoUsername($username)) {
            throw UsernameGiaUsatoException::conValore($username);
        }

        $giocatore = Giocatore::nuovo(
            $username,
            new DatiAnagrafici($command->nome, $command->cognome)
        );
        $this->repository->salva($giocatore);
        $this->dispatchEventi($giocatore);
    }

    public function disattivaUnAccountGiocatore(DisattivaUnAccountGiocatoreCommand $command): void
    {
        $username = new Username($command->username);
        $giocatore = $this->repository->carica($username);

        $giocatore->disattiva();

        $this->repository->salva($giocatore);
        $this->dispatchEventi($giocatore);
    }

    private function dispatchEventi(Giocatore $giocatore): void
    {
        $this->eventBus->dispatchAll($giocatore->eventi());
    }
}
