<?php

namespace App\ApplicationTests;

use App\Common\Tests\Application\BaseWebTestCase;
use Ramsey\Uuid\Uuid;

class AttivazioneTorneoTest extends BaseWebTestCase
{
    /** @test */
    public function seAttivoUnTorneoDevoRicevere200()
    {
        $this->post('/gestione_tornei/crea', []);
        $tornei = $this->get('/gestione_tornei/tornei');
        $idTorneo = $tornei[0]['id'];

        $this->patch('/gestione_tornei/attiva', ['id' => $idTorneo]);

        $this->checkResponse200();
    }

    /** @test */
    public function seAttivoUnTorneoCheNonEsisteDevoRicevere404()
    {
        $this->patch('/gestione_tornei/attiva', ['id' => Uuid::uuid4()]);

        $this->checkResponse400();
    }

    /** @test */
    public function seAttivoUnTorneoDevoVederloNellaPartiteListaTorneiAttivi()
    {
        $this->post('/gestione_tornei/crea', []);
        $tornei = $this->get('/gestione_tornei/tornei');
        $idTorneo = $tornei[0]['id'];
        $this->patch('/gestione_tornei/attiva', ['id' => $idTorneo]);

        $torneiAttivi = $this->get('/partite/tornei_attivi');

        $this->assertCount(1, $torneiAttivi);
        $this->assertEquals($idTorneo, $torneiAttivi[0]['id']);
    }
}
