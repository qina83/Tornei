<?php

namespace App\Partite\Application\Listener;

use App\Common\Domain\Evento;
use App\Common\Domain\GestioneUtenti\DatiAnagrafici;
use App\Common\Domain\GestioneUtenti\Username;
use App\Partite\Domain\GiocatoreAttivoRepository;
use App\Partite\Domain\ReadModel\GiocatoreAttivo;

class EventiGiocatori
{
    public function __construct(
        private GiocatoreAttivoRepository $repository
    ) {
    }

    public function whenGiocatoreCreato(Evento $evento)
    {
        $dati = $evento->dati();
        $giocatoreAttivo = new GiocatoreAttivo(
            new Username($dati['username']),
            new DatiAnagrafici(
                $dati['nome'],
                $dati['cognome']
            )
        );
        $this->repository->aggiungiGiocatoreAttivo($giocatoreAttivo);
    }

    public function whenGiocatoreDisattivato(Evento $evento)
    {
        $dati = $evento->dati();
        $this->repository->rimuoviGiocatoreAttivo(new Username($dati['username']));
    }
}
