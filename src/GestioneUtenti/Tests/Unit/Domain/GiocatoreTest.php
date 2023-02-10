<?php

namespace App\GestioneUtenti\Tests\Unit\Domain;

use App\Common\Domain\GestioneUtenti\DatiAnagrafici;
use App\Common\Domain\GestioneUtenti\Username;
use App\GestioneUtenti\Domain\Event\EventoGiocatoreCreato;
use App\GestioneUtenti\Domain\Event\EventoGiocatoreDisattivato;
use App\GestioneUtenti\Domain\Giocatore;
use PHPUnit\Framework\TestCase;

class GiocatoreTest extends TestCase
{
    /** @test */
    public function quandoCreoIlGiocatoreDevoEmettereEventoGiocatoreCreato()
    {
        $giocatore = Giocatore::nuovo(
            new Username('a@a.aa'),
            new DatiAnagrafici(
                'mario',
                'rossi'
            )
        );

        $eventi = $giocatore->eventi();

        $this->assertCount(1, $eventi);
        $this->assertTrue($eventi->get(0) instanceof EventoGiocatoreCreato);
        $this->assertEquals($eventi->get(0)->dati()['username'], 'a@a.aa');
    }

    /** @test */
    public function quandoDisattivoUnGiocatoreDevoEmettereEventoGiocatoreDisattivato()
    {
        $giocatore = Giocatore::nuovo(
            new Username('a@a.aa'),
            new DatiAnagrafici(
                'mario',
                'rossi'
            )
        );

        $giocatore->disattiva();

        $eventi = $giocatore->eventi();

        $this->assertCount(2, $eventi);
        $this->assertTrue($eventi->get(1) instanceof EventoGiocatoreDisattivato);
        $this->assertEquals($eventi->get(1)->dati()['username'], 'a@a.aa');
    }
}
