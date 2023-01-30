<?php

namespace App\GestioneTornei\Tests\Application;

use App\Common\Application\EventBus;
use App\GestioneTornei\Application\Command\CreaNuovoTorneoCommand;
use App\GestioneTornei\Application\GestioneTorneiService;
use App\GestioneTornei\Domain\TorneoRepository;
use PHPUnit\Framework\TestCase;

class GestioneTorneiServiceTest extends TestCase
{
    private EventBus $eventBus;
    private TorneoRepository $torneoRepository;

    private GestioneTorneiService $gestioneTorneiService;

    protected function setUp(): void
    {
        $this->eventBus = $this->createMock(EventBus::class);
        $this->torneoRepository = $this->createMock(TorneoRepository::class);

        $this->gestioneTorneiService = new GestioneTorneiService(
            $this->torneoRepository,
            $this->eventBus
        );
    }

    /**
     * @test
     */
    public function seCreoUnTorneoDevoSalvarloADb()
    {
        $this->torneoRepository
            ->expects($this->once())
            ->method('salva');

        $command = new CreaNuovoTorneoCommand();

        $this->gestioneTorneiService
            ->creaUnNuovoTorneo($command);
    }

    /**
     * @test
     */
    public function seCreoUnTorneoLanciareGliEventiDiDominio()
    {
        $this->eventBus
            ->expects($this->once())
            ->method('dispatchAll');

        $command = new CreaNuovoTorneoCommand();

        $this->gestioneTorneiService
            ->creaUnNuovoTorneo($command);
    }
}
