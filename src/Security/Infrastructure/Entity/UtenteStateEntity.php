<?php

namespace App\Security\Infrastructure\Entity;

use App\Security\Infrastructure\Repository\PostgreUtenteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostgreUtenteRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ORM\Table(name: 'security_utente_state')]
class UtenteStateEntity
{
    #[ORM\Id]
    #[ORM\Column(unique: true)]
    public string $username;

    #[ORM\Column]
    public string $roles;

    #[ORM\Column]
    public string $password;

    public function updateFromArray(array $data): void
    {
        $this->username = $data['username'];
        $this->password = $data['password'];
        $this->roles = $data['roles'];
    }

    public function toArray()
    {
        return [
            'username' => $this->username,
            'password' => $this->password,
            'roles' => $this->roles,
        ];
    }

}
