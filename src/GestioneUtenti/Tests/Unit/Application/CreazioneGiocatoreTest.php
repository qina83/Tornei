<?php

namespace App\GestioneUtenti\Tests\Unit\Application;

use App\Common\Application\EventBus;
use App\GestioneUtenti\Application\Command\IscrivimiComeGiocatoreCommand;
use App\GestioneUtenti\Application\GestioneUtentiService;
use App\GestioneUtenti\Domain\Exception\UsernameGiaUsatoException;
use App\GestioneUtenti\Domain\GiocatoreRepository;
use PHPUnit\Framework\TestCase;

class CreazioneGiocatoreTest extends TestCase
{
    private GestioneUtentiService $gestioneUtentiService;
    private GiocatoreRepository $repository;
    private EventBus $eventBus;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(GiocatoreRepository::class);
        $this->eventBus = $this->createMock(EventBus::class);

        $this->gestioneUtentiService = new GestioneUtentiService(
            $this->repository,
            $this->eventBus
        );
    }

    /** @test */
    public function quandoIscrivoUnGiocatoreDevoSalvarloEDispatchareGliEventi()
    {
        $command = IscrivimiComeGiocatoreCommand::fromArray(
            [
                'username' => 'aa@aa.aa',
                'nome' => 'mario',
                'cognome' => 'rossi',
            ]
        );

        $this->repository
            ->method('esisteGiocatoreConStessoUsername')
            ->willReturn(false);

        $this->repository
            ->expects($this->once())
            ->method('salva');

        $this->eventBus
            ->expects($this->once())
            ->method('dispatchAll');

        $this->gestioneUtentiService->iscrivimiComeGiocatore($command);
    }

    /** @test */
    public function quandoIscrivoUnGiocatoreSeEsisteGiaUsernameDevoLanciareEccezione()
    {
        $command = IscrivimiComeGiocatoreCommand::fromArray(
            [
                'username' => 'aa@aa.aa',
                'nome' => 'mario',
                'cognome' => 'rossi',
            ]
        );

        $this->repository
            ->method('esisteGiocatoreConStessoUsername')
            ->willReturn(true);

        $this->expectException(UsernameGiaUsatoException::class);

        $this->gestioneUtentiService->iscrivimiComeGiocatore($command);
    }
}
