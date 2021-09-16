<?php

namespace App\DTO;

use App\Traits\Jsonable;
use Illuminate\Support\Collection;

class ApiResponseDto
{
    use Jsonable;

    private bool $success;
    private ?string $message;
    private ?Collection $data;

    public function __construct()
    {
        $this->success = false;
        $this->message = null;
        $this->data = null;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function setSuccess(bool $success): self
    {
        $this->success = $success;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getData(): ?Collection
    {
        return $this->data;
    }

    public function setData(?Collection $data): self
    {
        $this->data = $data;

        return $this;
    }
}
