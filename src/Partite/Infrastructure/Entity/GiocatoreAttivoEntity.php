<?php

namespace App\Partite\Infrastructure\Entity;

use App\Partite\Domain\ReadModel\GiocatoreAttivo;
use App\Partite\Infrastructure\PostgreGiocatoreAttivoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostgreGiocatoreAttivoRepository::class)]
#[ORM\Table(name: 'partite_giocatori_attivi')]
class GiocatoreAttivoEntity
{
    #[ORM\Id]
    #[ORM\Column]
    public string $username;

    #[ORM\Column]
    public string $nome;

    #[ORM\Column]
    public string $cognome;

    private function __construct()
    {
    }

    public static function fromGiocatoreAttivo(GiocatoreAttivo $giocatoreAttivo): self
    {
        $self = new self();
        $self->username = $giocatoreAttivo->username->value();
        $self->nome = $giocatoreAttivo->datiAnagrafici->nome();
        $self->cognome = $giocatoreAttivo->datiAnagrafici->cognome();

        return $self;
    }
}
