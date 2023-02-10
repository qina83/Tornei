<?php

namespace App\Common\Tests\Unit\Domain\GestioneUtenti;

use App\Common\Domain\GestioneUtenti\DatiAnagrafici;
use PHPUnit\Framework\TestCase;

class DatiAnagraficiTest extends TestCase
{
    /** @test */
    public function deveGarantireNomeCognomeNonVuoti()
    {
        $this->expectException(\Throwable::class);

        new DatiAnagrafici('', '');
    }
}
