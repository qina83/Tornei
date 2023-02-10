<?php

namespace App\Common\Application;

trait TypeTrait
{
    public static function getString(array $data, string $key): string
    {
        return $data[$key] ?? '';
    }
}
