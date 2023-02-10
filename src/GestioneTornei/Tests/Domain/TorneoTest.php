<?php

namespace App\GestioneTornei\Tests\Domain;

use App\GestioneTornei\Domain\Event\EventoTorneoAttivato;
use App\GestioneTornei\Domain\Event\EventoTorneoCreato;
use App\GestioneTornei\Domain\Event\EventoTorneoDisattivato;
use App\GestioneTornei\Domain\StatoAttivazioneTorneo;
use App\GestioneTornei\Domain\Torneo;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class TorneoTest extends TestCase
{
    /**
     * @test
     */
    public function ogniNuovoTorneoDeveAvereUnIdDiverso()
    {
        $torneo1 = Torneo::nuovo();
        $torneo2 = Torneo::nuovo();

        $stateTornei1 = $torneo1->toArray();
        $stateTornei2 = $torneo2->toArray();

        $this->assertNotEquals($stateTornei1['id'], $stateTornei2['id']);
    }

    /**
     * @test
     */
    public function datoUnoStatoTorneoDeveReidratarsi()
    {
        $guid = Uuid::uuid4()->toString();
        $state = [
            'id' => $guid,
            'statoAttivazione' => StatoAttivazioneTorneo::disattivato()->stringValue()
        ];

        $torneo = Torneo::fromArray($state);
        $state = $torneo->toArray();

        $this->assertEquals($state['id'], $guid);
    }

    /**
     * @test
     */
    public function quandoCreoUnTorneoDevoEmettereUnEventoDiCreazione()
    {
        $torneo = Torneo::nuovo();
        $eventi = $torneo->eventi();
        $id = $torneo->toArray()['id'];

        $this->assertCount(1, $eventi);
        $this->assertTrue($eventi->get(0) instanceof EventoTorneoCreato);
        $this->assertEquals($eventi->get(0)->dati()['id'], $id);
    }


    /**
     * @test
     */
    public function quandoCreoUnTorneoDeveEssereDisattivato()
    {
        $torneo = Torneo::nuovo();
        $statoAttivazione = StatoAttivazioneTorneo::fromString($torneo->toArray()['statoAttivazione']);

        $this->assertTrue($statoAttivazione->eDisattivato());
    }

    /**
     * @test
     */
    public function quandoAttivoUnTorneoNuovoDevoAvereEventoTorneoAttivato()
    {
        $torneo = Torneo::nuovo();
        $torneo->attiva();
        $eventi = $torneo->eventi();
        $id = $torneo->toArray()['id'];

        $this->assertCount(2, $eventi);
        $this->assertTrue($eventi->get(1) instanceof EventoTorneoAttivato);
        $this->assertEquals($eventi->get(0)->dati()['id'], $id);
    }

    /**
     * @test
     */
    public function quandoAttivoUnTorneoAttivatoNonDevoAvereEventoTorneoAttivato()
    {
        $torneo = Torneo::nuovo();
        $torneo->attiva();
        $torneo->attiva();
        $eventi = $torneo->eventi();

        $this->assertCount(2, $eventi);
    }

    /**
     * @test
     */
    public function quandoDisattivoUnTorneoNuovoNonDevoAvereEventoTorneoDisattivato()
    {
        $torneo = Torneo::nuovo();
        $torneo->disattiva();
        $eventi = $torneo->eventi();

        $this->assertCount(1, $eventi);
        $this->assertFalse($eventi->get(0) instanceof EventoTorneoDisattivato);
    }

    /**
     * @test
     */
    public function quandoDisattivoUnTorneoAttivatoDevoAvereEventoTorneoDisattivato()
    {
        $torneo = Torneo::nuovo();
        $torneo->attiva();
        $torneo->disattiva();
        $eventi = $torneo->eventi();

        $this->assertCount(3, $eventi);
        $this->assertTrue($eventi->get(2) instanceof EventoTorneoDisattivato);
    }
}
