<?php

namespace App\DTO\Repairment;

use App\Traits\Jsonable;

class RepairmentDto
{
    use Jsonable;

    private int $id;
    private string $name;
    private string $slug;
    private string $description;
    private float $price;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return RepairmentDto
     */
    public function setId(int $id): RepairmentDto
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return RepairmentDto
     */
    public function setName(string $name): RepairmentDto
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     * @return RepairmentDto
     */
    public function setSlug(string $slug): RepairmentDto
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return RepairmentDto
     */
    public function setDescription(string $description): RepairmentDto
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return RepairmentDto
     */
    public function setPrice(float $price): RepairmentDto
    {
        $this->price = $price;

        return $this;
    }
}
