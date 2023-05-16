<?php

namespace App\GestioneTornei\Infrastructure;

use App\GestioneTornei\Application\Command\AttivaTorneoCommand;
use App\GestioneTornei\Application\Command\CreaNuovoTorneoCommand;
use App\GestioneTornei\Application\Command\DisattivaTorneoCommand;
use App\GestioneTornei\Application\GestioneTornei;
use App\GestioneTornei\Application\Query\TorneiNonEliminatiQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Webmozart\Assert\Assert;

#[Route('/gestione_tornei')]
class GestioneTorneiController extends AbstractController
{
    #[Route('/crea', name: 'crea_nuovo_torneo', methods: 'POST')]
    public function crea(
        GestioneTornei $gestioneTornei,
    ): Response {

        $comando = new CreaNuovoTorneoCommand();
        $gestioneTornei->creaUnNuovoTorneo($comando);

        return new Response();
    }

    #[Route('/attiva', name: 'attiva_torneo', methods: 'PATCH')]
    public function attiva(
        GestioneTornei $gestioneTornei,
        Request $request
    ): Response {
        $requestData = $request->toArray();
        Assert::keyExists($requestData, 'id');

        $comando = AttivaTorneoCommand::fromData($requestData);
        $gestioneTornei->attivaUnTorneo($comando);

        return new Response();
    }

    #[Route('/disattiva', name: 'disattiva_torneo', methods: 'PATCH')]
    public function disattiva(
        GestioneTornei $gestioneTornei,
        Request $request
    ): Response {
        $requestData = $request->toArray();
        Assert::keyExists($requestData, 'id');

        $comando = DisattivaTorneoCommand::fromData($requestData);
        $gestioneTornei->disattivaUnTorneo($comando);

        return new Response();
    }

    #[Route('/tornei', name: 'lista_tornei_non_eliminati', methods: 'GET')]
    public function torneiNonEliminati(
        GestioneTornei $gestioneTornei,
    ): Response {
        $query = new TorneiNonEliminatiQuery();
        $tornei = $gestioneTornei->recuperaListaTorneiNonEliminati($query);

        return new JsonResponse($tornei->toArray());
    }
}
