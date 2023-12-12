<?php

declare(strict_types=1);

namespace Devel96\Converter\Traits;

trait Singleton
{
    private static ?self $_instance = null;

    private function __construct() {}
    private function __clone() {}

    public static function getInstance(): self
    {
        if (!self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }
}