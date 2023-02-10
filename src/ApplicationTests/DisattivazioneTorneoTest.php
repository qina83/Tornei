<?php

namespace App\ApplicationTests;

use App\Common\Tests\Application\BaseWebTestCase;
use Ramsey\Uuid\Uuid;

class DisattivazioneTorneoTest extends BaseWebTestCase
{
    /** @test */
    public function seDisattivoUnTorneoDevoRicevere200()
    {
        $this->post('/gestione_tornei/crea', []);
        $tornei = $this->get('/gestione_tornei/tornei');
        $idTorneo = $tornei[0]['id'];
        $this->patch('/gestione_tornei/attiva', ['id' => $idTorneo]);
        $this->patch('/gestione_tornei/disattiva', ['id' => $idTorneo]);
        $this->checkResponse200();
    }

    /** @test */
    public function seAttivoUnTorneoCheNonEsisteDevoRicevere404()
    {
        $this->patch('/gestione_tornei/disattiva', ['id' => Uuid::uuid4()]);

        $this->checkResponse400();
    }

    /** @test */
    public function seAttivoUnTorneoDevoVederloNellaPartiteListaTorneiAttivi()
    {
        $this->post('/gestione_tornei/crea', []);
        $tornei = $this->get('/gestione_tornei/tornei');
        $idTorneo = $tornei[0]['id'];
        $this->patch('/gestione_tornei/attiva', ['id' => $idTorneo]);
        $this->patch('/gestione_tornei/disattiva', ['id' => $idTorneo]);

        $torneiAttivi = $this->get('/partite/tornei_attivi');

        $this->assertCount(0, $torneiAttivi);
    }
}
