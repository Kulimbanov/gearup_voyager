<?php

namespace App\DTO\Shop;

use App\Traits\Jsonable;
use Illuminate\Support\Collection;
use JsonSerializable;

class ListProductDto implements JsonSerializable
{
    use Jsonable;

    private string $slug;
    private string $name;
    private ?string $image;
    private ?string $brand;
    private string $category;
    private ?float $price;
    private Collection $properties;

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): ListProductDto
    {
        $this->slug = $slug;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): ListProductDto
    {
        $this->name = $name;

        return $this;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): ListProductDto
    {
        $this->brand = $brand;

        return $this;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): ListProductDto
    {
        $this->category = $category;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): ListProductDto
    {
        $this->price = $price;

        return $this;
    }

    public function getProperties(): Collection
    {
        return $this->properties;
    }

    public function setProperties(Collection $properties): ListProductDto
    {
        $this->properties = $properties;

        return $this;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): ListProductDto
    {
        $this->image = $image;

        return $this;
    }
}
