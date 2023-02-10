<?php

namespace App\ApplicationTests;

use App\Common\Tests\Application\BaseWebTestCase;

class DisattivazioneGiocatoreTest extends BaseWebTestCase
{
    /** @test */
    public function seDisattivoUnGiocatoreNonLoDevoVedereNellaPartiteListaGiocatoriAttivi()
    {
        $username1 = uniqid('username_').'@test.test';
        $username2 = uniqid('username_').'@test.test';
        $username3 = uniqid('username_').'@test.test';

        $this->post('/gestione_utenti/iscrivimi', $this->creaDatiGiocatore($username1));
        $this->post('/gestione_utenti/iscrivimi', $this->creaDatiGiocatore($username2));
        $this->post('/gestione_utenti/iscrivimi', $this->creaDatiGiocatore($username3));

        $this->patch('/gestione_utenti/disattiva_account_utente', ['username' => $username2]);

        $giocatoriAttivi = $this->get('/partite/giocatori_attivi');

        $this->assertCount(2, $giocatoriAttivi);
        $this->assertEquals($username1, $giocatoriAttivi[0]['username']);
        $this->assertEquals($username3, $giocatoriAttivi[1]['username']);
    }

    /** @test */
    public function seDisattivoUnGiocatoreNonEsistenteResitituisceNotFound()
    {
        $this->patch('/gestione_utenti/disattiva_account_utente', ['username' => uniqid('username_').'@test.test']);

        $this->checkResponse404();
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
