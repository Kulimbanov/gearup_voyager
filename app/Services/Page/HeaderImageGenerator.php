<?php

namespace App\Services\Page;

use TCG\Voyager\Facades\Voyager;

final class HeaderImageGenerator
{
    public static function generateHeaderImage(?string $preferImage): string
    {
        return Voyager::image(!empty($preferImage) ? $preferImage : setting('site.headerImage'));
    }
}
