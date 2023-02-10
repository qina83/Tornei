<?php

namespace App\Common\Tests\Unit\Infrastructure;

use App\Common\Domain\Eventi;
use App\Common\Infrastructure\SimpleEventBus;
use PHPUnit\Framework\TestCase;

class SimpleEventBusTest extends TestCase
{
    /** @test */
    public function deveFunzionareSenzaEventi()
    {
        $bus = new SimpleEventBus([]);

        $this->expectNotToPerformAssertions();
        $bus->dispatchAll(new Eventi());
    }

    /** @test */
    public function deveFunzionareSenzaSubscribers()
    {
        $bus = new SimpleEventBus([]);

        $this->expectNotToPerformAssertions();
        $bus->dispatchAll(new Eventi([
            new EventoDiTest(),
        ]));
    }

    /** @test */
    public function seEventoHaSottoscrittoriDeveChiamareIlMetodoWhenNomeEvento()
    {
        $eventoDiTest = new EventoDiTest();

        $subscribers = $this->createMock(SubscriberDiTest::class);
        $subscribers
            ->expects($this->once())
            ->method('whenEventoDiTestLanciato')
            ->with($eventoDiTest);

        $bus = new SimpleEventBus([
            'eventoDiTestLanciato' => [
                $subscribers,
            ],
        ]);

        $bus->dispatchAll(new Eventi([
            $eventoDiTest,
        ]));
    }
}
