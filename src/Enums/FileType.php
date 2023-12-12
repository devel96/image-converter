<?php

declare(strict_types=1);

namespace Devel96\Converter\Enums;

class FileType
{
    public const JPEG = 'jpeg';
    public const PNG = 'png';
    public const GIF = 'gif';
    public const WEBP = 'webp';

    /**
     * @return array<array-key, string>
     */
    public static function getAvailableTypes(): array
    {
        return [
            self::JPEG,
            self::PNG,
            self::GIF,
            self::WEBP,
        ];
    }
}