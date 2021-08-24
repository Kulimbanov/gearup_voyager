<?php

namespace App\DTO\Page;

class PublicPageDto
{
    public string $title;
    public ?string $subTitle;
    public ?string $headerImage;
    public ?string $body;
    public ?string $template;
    public ?int $category_id;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(?string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    public function setCategoryId(int $category_id): self
    {
        $this->category_id = $category_id;

        return $this;
    }

    public function getSubTitle(): ?string
    {
        return $this->subTitle;
    }

    public function setSubTitle(?string $subTitle): PublicPageDto
    {
        $this->subTitle = $subTitle;

        return $this;
    }

    public function getHeaderImage(): ?string
    {
        return $this->headerImage;
    }

    public function setHeaderImage(?string $headerImage): PublicPageDto
    {
        $this->headerImage = $headerImage;

        return $this;
    }

    public function getTemplate(): ?string
    {
        return $this->template;
    }

    public function setTemplate(?string $template): PublicPageDto
    {
        $this->template = $template;

        return $this;
    }
}
