<?php

namespace App\GestioneUtenti\Infrastructure;

use App\GestioneUtenti\Application\Command\DisattivaUnAccountGiocatoreCommand;
use App\GestioneUtenti\Application\Command\IscrivimiComeGiocatoreCommand;
use App\GestioneUtenti\Application\GestioneUtenti;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Webmozart\Assert\Assert;

#[Route('/gestione_utenti')]
class GestioneUtentiController extends AbstractController
{
    #[Route('/iscrivimi', name: 'crea_nuovo_giocatore', methods: 'POST')]
    public function crea(
        GestioneUtenti $gestioneUtenti,
        Request $request
    ): Response {
        $requestData = $request->toArray();
        Assert::keyExists($requestData, 'username');
        Assert::keyExists($requestData, 'nome');
        Assert::keyExists($requestData, 'cognome');

        $command = IscrivimiComeGiocatoreCommand::fromArray($requestData);
        $gestioneUtenti->iscrivimiComeGiocatore($command);

        return new Response();
    }

    #[Route('/disattiva_account_utente', name: 'disattiva_giocatore', methods: 'PATCH')]
    public function disattivaAccountUtente(
        GestioneUtenti $gestioneUtenti,
        Request $request
    ): Response {
        $requestData = $request->toArray();
        Assert::keyExists($requestData, 'username');

        $command = DisattivaUnAccountGiocatoreCommand::fromArray($requestData);
        $gestioneUtenti->disattivaUnAccountGiocatore($command);

        return new Response();
    }
}
