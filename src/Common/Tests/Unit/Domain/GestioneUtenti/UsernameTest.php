<?php

namespace App\Common\Tests\Unit\Domain\GestioneUtenti;

use App\Common\Domain\GestioneUtenti\Username;
use PHPUnit\Framework\TestCase;

class UsernameTest extends TestCase
{
    /** @test */
    public function loUsernameDeveEssereInFormatoEmail()
    {
        new Username('test@test.test');

        $this->expectException(\Throwable::class);
        new Username('noEmail');
    }
}
