<?php

namespace App\Partite\Infrastructure\Entity;

use App\Partite\Domain\ReadModel\TorneoAttivo;
use App\Partite\Infrastructure\PostgreTorneoAttivoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostgreTorneoAttivoRepository::class)]
#[ORM\Table(name: 'partite_tornei_attivi')]
class TorneoAttivoEntity
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    public string $id;

    private function __construct()
    {
    }

    public static function fromTorneoAttivo(TorneoAttivo $torneoAttivo): self
    {
        $self = new self();
        $self->id = $torneoAttivo->id->stringValue();

        return $self;
    }
}
