<?php

namespace App\DTO\Page;

use Illuminate\Support\Collection;

class ProductPageDto extends PublicPageDto
{
    private ?float $price;
    private ?string $category;
    private Collection $images;
    private Collection $brands;

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): ProductPageDto
    {
        $this->price = $price;

        return $this;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): ProductPageDto
    {
        $this->category = $category;

        return $this;
    }

    public function getBrands(): Collection
    {
        return $this->brands;
    }

    public function setBrands(Collection $brands): ProductPageDto
    {
        $this->brands = $brands;

        return $this;
    }

    public function getImages(): Collection
    {
        return $this->images;
    }

    public function setImages(Collection $images): ProductPageDto
    {
        $this->images = $images;

        return $this;
    }
}
