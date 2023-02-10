<?php

namespace App\Common\Tests\Unit\Infrastructure;

use App\Common\Domain\Evento;

class EventoDiTest implements Evento
{
    public function nome(): string
    {
        return 'eventoDiTestLanciato';
    }

    public function dati(): array
    {
        return [];
    }
}
