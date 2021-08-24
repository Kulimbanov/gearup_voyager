<?php

namespace App\DTO\Page;

use App\Traits\Jsonable;
use JsonSerializable;

class ContactFormDto implements JsonSerializable
{
    use Jsonable;

    private int $id;
    private string $name;
    private string $phone;
    private string $email;
    private string $subject;
    private string $message;
    private ?string $response;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): ContactFormDto
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): ContactFormDto
    {
        $this->name = $name;

        return $this;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): ContactFormDto
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): ContactFormDto
    {
        $this->email = $email;

        return $this;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): ContactFormDto
    {
        $this->subject = $subject;

        return $this;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): ContactFormDto
    {
        $this->message = $message;

        return $this;
    }

    public function getResponse(): ?string
    {
        return $this->response;
    }

    public function setResponse(?string $response): ContactFormDto
    {
        $this->response = $response;

        return $this;
    }
}
