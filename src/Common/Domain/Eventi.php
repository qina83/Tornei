<?php

namespace App\Common\Domain;

class Eventi extends \ArrayIterator
{
    public function get(int $index): Evento
    {
        return $this[$index];
    }
}
