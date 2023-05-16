<?php

namespace App\Security\Application\Listener;

use App\Common\Domain\Evento;
use App\Security\Application\Security;
use App\Security\Domain\Utente;
use App\Security\Domain\UtenteRepository;

class EventiGiocatori
{
    public function __construct(
        private UtenteRepository $utenteRepository,
        private Security $security
    ) {
    }

    public function whenGiocatoreCreato(Evento $evento)
    {
        $username = $evento->dati()['username'];
        $password = 'password';
        $utente = new Utente($username, $password, ['giocatore']);
        $hasedPassword = $this->security->encodePassword($password);
        $utente->setPassword($hasedPassword);

        $this->utenteRepository->aggiungiUtente($utente);
    }

    public function whenGiocatoreDisattivato(Evento $evento)
    {
        $username = $evento->dati()['username'];
        $this->utenteRepository->rimuoviUtente($username);
    }
}
