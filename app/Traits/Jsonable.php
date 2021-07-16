<?php

namespace App\Traits;

trait Jsonable
{
    public function jsonSerialize(): array
    {
        $result = [];
        if (is_callable('parent::jsonSerialize')) {
            $result = parent::jsonSerialize();
        }

        return array_merge($result, get_object_vars($this));
    }
}
