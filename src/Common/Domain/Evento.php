<?php

namespace App\Common\Domain;

interface Evento
{
    public function nome(): string;

    public function dati(): array;
}
