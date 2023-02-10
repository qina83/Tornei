<?php

namespace App\Common\Domain\GestioneUtenti;

use Webmozart\Assert\Assert;

final readonly class DatiAnagrafici
{
    private string $nome;
    private string $cognome;

    public function __construct(
        string $nome,
        string $cognome
    ) {
        $this->nome = trim($nome);
        $this->cognome = trim($cognome);

        Assert::notEmpty($this->nome);
        Assert::notEmpty($this->cognome);
    }

    public function nome()
    {
        return $this->nome;
    }

    public function cognome()
    {
        return $this->cognome;
    }
}
