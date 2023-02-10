<?php

namespace App\GestioneTornei\Tests\Unit\Application;

use App\Common\Application\EventBus;
use App\GestioneTornei\Application\Command\AttivaTorneoCommand;
use App\GestioneTornei\Application\Command\CreaNuovoTorneoCommand;
use App\GestioneTornei\Application\Command\DisattivaTorneoCommand;
use App\GestioneTornei\Application\GestioneTorneiService;
use App\GestioneTornei\Domain\Torneo;
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

    /**
     * @test
     */
    public function seAttivoUnTorneoDevoLanciareGliEventiDiDominio()
    {
        $torneo = Torneo::nuovo();

        $this->torneoRepository
            ->method('carica')
            ->willReturn($torneo);

        $this->eventBus
            ->expects($this->once())
            ->method('dispatchAll');

        $command = new AttivaTorneoCommand(
            $torneo->toArray()['id']
        );

        $this->gestioneTorneiService
            ->attivaUnTorneo($command);
    }

    public function seDisattivoUnTorneoDevoLanciareGliEventiDiDominio()
    {
        $torneo = Torneo::nuovo();
        $torneo->attiva();

        $this->torneoRepository
            ->method('carica')
            ->willReturn($torneo);

        $this->eventBus
            ->expects($this->once())
            ->method('dispatchAll');

        $command = new DisattivaTorneoCommand(
            $torneo->toArray()['id']
        );

        $this->gestioneTorneiService
            ->disattivaUnTorneo($command);
    }
}
