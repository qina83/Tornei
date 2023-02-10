<?php

namespace App\GestioneUtenti\Infrastructure\Entity;

use App\GestioneUtenti\Infrastructure\Repository\PostgreGiocatoreRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\PrePersist;

#[ORM\Entity(repositoryClass: PostgreGiocatoreRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ORM\Table(name: 'gestione_utenti_giocatori_state')]
class GiocatoreStateEntity
{
    #[ORM\Id]
    #[ORM\Column(unique: true)]
    public string $username;

    #[ORM\Column]
    public \DateTime $lastUpdate;

    #[ORM\Column]
    public bool $statoAttivazioneAccount;

    #[ORM\Column]
    public string $nome;

    #[ORM\Column]
    public string $cognome;

    public function updateFromArray(array $data): void
    {
        $this->username = $data['username'];
        $this->statoAttivazioneAccount = $data['statoAttivazioneAccount'];
        $this->nome = $data['nome'];
        $this->cognome = $data['cognome'];
    }

    public function toArray()
    {
        return [
            'username' => $this->username,
            'statoAttivazioneAccount' => $this->statoAttivazioneAccount,
            'nome' => $this->nome,
            'cognome' => $this->cognome,
        ];
    }

    #[PrePersist]
    public function updatedTimestamps(): void
    {
        $this->lastUpdate = new \DateTime();
    }
}
