<?php

namespace App\Partite\Infrastructure;

use App\Partite\Application\Partite;
use App\Partite\Application\Query\GiocatoriAttiviQuery;
use App\Partite\Application\Query\TorneiAttiviQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/partite')]
class PartiteController extends AbstractController
{
    #[Route('/tornei_attivi', name: 'lista_tornei_attivi', methods: 'GET')]
    public function torneiAttivi(
        Partite $partite,
    ): Response {
        $query = new TorneiAttiviQuery();
        $tornei = $partite->listaTorneiAttivi($query);

        return new JsonResponse($tornei->toArray());
    }

    #[Route('/giocatori_attivi', name: 'lista_giocatori_attivi', methods: 'GET')]
    public function giocatoriAttivi(
        Partite $partite,
    ): Response {
        $query = new GiocatoriAttiviQuery();
        $tornei = $partite->listaGiocatoriAttivi($query);

        return new JsonResponse($tornei->toArray());
    }
}
