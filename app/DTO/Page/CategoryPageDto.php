<?php

namespace App\DTO\Page;

use App\Services\Page\Type\IPublicPage;

class CategoryPageDto extends PublicPageDto implements IPublicPage
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
