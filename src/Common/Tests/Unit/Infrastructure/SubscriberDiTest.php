<?php

namespace App\Common\Tests\Unit\Infrastructure;

use App\Common\Domain\Evento;

interface SubscriberDiTest
{
    public function whenEventoDiTestLanciato(Evento $event);
}
