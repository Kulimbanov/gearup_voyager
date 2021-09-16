<?php

namespace App\DTO\Auth;

class UserDto
{
    private ?string $name;
    private string $email;
    private string $password;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getCredentials(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
        ];
    }

}
