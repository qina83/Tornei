<?php

namespace App\Common\Tests\Unit\Domain\GestioneTornei;

use App\Common\Domain\GestioneTornei\IdTorneo;
use PHPUnit\Framework\TestCase;

class IdTorneoTest extends TestCase
{
    /** @test */
    public function seNonPassUnoUuidv4DeveLanciareEccezione()
    {
        $this->expectException(\Throwable::class);
        IdTorneo::fromString('noUuid');
    }

    /** @test */
    public function seCreoUnNuovoIdDeveEssereSempreConValoreDiverso()
    {
        $id1 = IdTorneo::nuovo();
        $id2 = IdTorneo::nuovo();

        self::assertNotEquals($id1->stringValue(), $id2->stringValue());
    }

    /** @test */
    public function seCreoUnIdAPartireDaUnaStringaIlValoreDeveEssereQuello()
    {
        $id1 = IdTorneo::nuovo();
        $id2 = IdTorneo::fromString($id1->stringValue());

        self::assertEquals($id1->stringValue(), $id2->stringValue());
    }
}
