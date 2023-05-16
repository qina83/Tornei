<?php

namespace App\Common\Tests\Security;

use App\Common\Tests\Application\BaseWebTestCase;

class ApiKeyAuthenticatorTest extends BaseWebTestCase
{
    /** @test */
    public function seCreoUnTorneoSenzaAuthenticazioneDevoRicevere401()
    {
        $this->post('/gestione_tornei/crea', []);

        $this->checkResponse401();
    }
}
