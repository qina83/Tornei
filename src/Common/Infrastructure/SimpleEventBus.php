<?php

namespace App\Common\Infrastructure;

use App\Common\Application\EventBus;
use App\Common\Domain\Eventi;
use App\Common\Domain\Evento;

class SimpleEventBus implements EventBus
{
    public function __construct(
        private readonly array $subscribers
    ) {
    }

    public function dispatchAll(Eventi $events): void
    {
        /** @var Evento $event */
        foreach ($events as $event) {
            foreach ($this->subscriberByEventName($event->nome()) as $subscriber) {
                $subscriber->{'when'.ucfirst($event->nome())}($event);
            }
        }
    }

    private function subscriberByEventName(string $nomeEvento)
    {
        return $this->subscribers[$nomeEvento] ?? [];
    }
}
