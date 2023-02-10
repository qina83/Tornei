<?php

namespace App\Common\Application;

use App\Common\Domain\Eventi;

interface EventBus
{
    public function dispatchAll(Eventi $events): void;
}
