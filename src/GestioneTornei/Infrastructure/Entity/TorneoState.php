<?php

namespace App\GestioneTornei\Infrastructure\Entity;

use App\GestioneTornei\Infrastructure\Repository\PostgreTorneoRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\PrePersist;

#[ORM\Entity(repositoryClass: PostgreTorneoRepository::class)]
#[ORM\HasLifecycleCallbacks]
class TorneoState
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    public string $id;

    #[ORM\Column(options: ["default" => 'now()'])]
    public \DateTime $lastUpdate;

    #[ORM\Column(options: ["default" => 'disattivato'])]
    public string $statoAttivazione;


    public function updateFromArray(array $data): void
    {
        $this->id = $data['id'];
        $this->statoAttivazione = $data['statoAttivazione'];
    }


    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'statoAttivazione' => $this->statoAttivazione
        ];
    }

    #[PrePersist]
    public function updatedTimestamps(): void
    {
        $this->lastUpdate = new \DateTime();
    }
}
