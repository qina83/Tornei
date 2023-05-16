<?php

namespace App\Security\Application\Listener;

use App\Common\Domain\Evento;
use App\Security\Domain\Utente;
use App\Security\Domain\UtenteRepository;

class EventiGiocatori
{
    public function __construct(
        private UtenteRepository $utenteRepository
    ) {
    }

    public function whenGiocatoreCreato(Evento $evento)
    {
        $username = $evento->dati()['username'];
        $utente = new Utente($username, 'password', ['giocatore']);
        $this->utenteRepository->aggiungiUtente($utente);
    }

    public function whenGiocatoreDisattivato(Evento $evento)
    {
        $username = $evento->dati()['username'];
        $this->utenteRepository->rimuoviUtente($username);
    }
}
