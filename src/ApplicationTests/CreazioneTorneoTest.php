<?php

namespace App\ApplicationTests;

use App\Common\Tests\Application\BaseWebTestCase;

class CreazioneTorneoTest extends BaseWebTestCase
{
    /** @test */
    public function seCreoUnTorneoDevoRicevere200()
    {
        $this->post('/gestione_tornei/crea', []);

        $this->checkResponse200();
    }

    /** @test */
    public function seCreoUnTorneoLoDevoVedereNellaListaTornei()
    {
        $this->post('/gestione_tornei/crea', []);
        $this->post('/gestione_tornei/crea', []);
        $this->post('/gestione_tornei/crea', []);

        $tornei = $this->get('/gestione_tornei/tornei');
        $this->assertCount(3, $tornei);
    }
}
