<?php

namespace App\Security\Domain;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class Utente implements UserInterface, PasswordAuthenticatedUserInterface
{
    public function __construct(
        private string $username,
        private string $password,
        private array $roles
    ) {
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function eraseCredentials()
    {

    }

    public function getUserIdentifier(): string
    {
        return $this->username;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $newPassword): void
    {
        $this->password = $newPassword;
    }

    public function toArray(): array
    {
        return [
            'username' => $this->username,
            'password' => $this->password,
            'roles' => json_encode($this->roles),
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['username'],
            $data['password'],
            json_decode($data['roles'], true)
        );
    }
}
