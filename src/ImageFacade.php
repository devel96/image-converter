<?php

declare(strict_types=1);

namespace Devel96\Converter;

abstract class ImageFacade
{
    /**
     * @throws Exceptions\InvalidFileTypeException
     * @throws Exceptions\InvalidFileException
     * @throws Exceptions\InvalidPathException
     */
    public static function convertToWebp(string $from, int $quality = 40): void
    {
        $directory = dirname($from);
        $fileName = pathinfo($from, PATHINFO_FILENAME);

        ImageManager::getInstance()->convert($from, $directory . '/' . $fileName, $quality);
    }
}