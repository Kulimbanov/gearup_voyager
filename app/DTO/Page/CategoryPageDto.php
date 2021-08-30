<?php

namespace App\DTO\Page;

class CategoryPageDto extends PublicPageDto
{
    public ?int $category_id;

    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    public function setCategoryId(int $category_id): self
    {
        $this->category_id = $category_id;

        return $this;
    }
}
