<?php

namespace App\ApplicationTests;

use App\Common\Tests\Application\BaseWebTestCase;

class CreazioneGiocatoreTest extends BaseWebTestCase
{
    /** @test */
    public function seCreoUnNuovoGiocatoreDevoRicevere200()
    {
        $username = uniqid('username_').'@test.test';
        $data = $this->creaDatiGiocatore($username);

        $this->post('/gestione_utenti/iscrivimi', $data);

        $this->checkResponse200();
    }

    /** @test */
    public function seCreoUnNuovoGiocatoreConUsernameEsistenteDevoRicevere400()
    {
        $username = uniqid('username_').'@test.test';
        $data = $this->creaDatiGiocatore($username);

        $this->post('/gestione_utenti/iscrivimi', $data);
        $this->post('/gestione_utenti/iscrivimi', $data);

        $this->checkResponse400();
    }

    /** @test */
    public function seCreoUnNuovoGiocatoreLoDevoVedereNellaPartiteListaGiocatoriAttivi()
    {
        $username1 = uniqid('username_').'@test.test';
        $username2 = uniqid('username_').'@test.test';
        $username3 = uniqid('username_').'@test.test';

        $this->post('/gestione_utenti/iscrivimi', $this->creaDatiGiocatore($username1));
        $this->post('/gestione_utenti/iscrivimi', $this->creaDatiGiocatore($username2));
        $this->post('/gestione_utenti/iscrivimi', $this->creaDatiGiocatore($username3));

        $giocatoriAttivi = $this->get('/partite/giocatori_attivi');

        $this->assertCount(3, $giocatoriAttivi);
        $this->assertEquals($username1, $giocatoriAttivi[0]['username']);
        $this->assertEquals($username2, $giocatoriAttivi[1]['username']);
        $this->assertEquals($username3, $giocatoriAttivi[2]['username']);
    }

    private function creaDatiGiocatore(string $username): array
    {
        return
            [
                'username' => $username,
                'nome' => 'mario',
                'cognome' => 'rossi',
            ];
    }
}
