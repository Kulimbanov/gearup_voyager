<?php

namespace App\Services\Page;

final class GetTemplateView
{
    public static function get(string $template): string
    {
        return 'page.templates.' . $template;
    }
}
