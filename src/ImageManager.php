<?php

declare(strict_types=1);

namespace Devel96\Converter;

use Devel96\Converter\Enums\FileType;
use Devel96\Converter\Exceptions\InvalidFileException;
use Devel96\Converter\Exceptions\InvalidFileTypeException;
use Devel96\Converter\Exceptions\InvalidPathException;
use Devel96\Converter\Traits\Singleton;

class ImageManager
{
    use Singleton;

    /**
     * @param string $from
     * @param string $to
     * @param int|null $quality
     * @return void
     * @throws InvalidFileException
     * @throws InvalidFileTypeException
     * @throws InvalidPathException
     */
    public function convert(string $from, string $to, ?int $quality = null): void
    {
        $this->checkPaths($from, $to);

        // get extensions
        $fromExtension = $this->getFileExtensionFromPath($from);
        $toExtension = $this->getOldFileExtensionFromPath($to);

        // set gd function names
        $functionFrom = "imagecreatefrom$fromExtension";
        $functionTo = "image$toExtension";

        // change the image type and quality
        $image = $functionFrom($from);
        imagepalettetotruecolor($image);

        if ($quality) {
            $functionTo($image, $to, $quality);
        } else {
            $functionTo($image, $to);
        }

        imagedestroy($image);
    }

    /**
     * @param string $from
     * @param string $to
     * @return void
     * @throws InvalidFileException
     * @throws InvalidPathException
     */
    private function checkPaths(string $from, string $to): void
    {
        if (!file_exists($from)) {
            throw new InvalidFileException();
        }

        if (!is_dir(dirname($to))) {
            throw new InvalidPathException();
        }
    }

    /**
     * @param string $path
     * @return string
     * @throws InvalidFileTypeException
     */
    private function getFileExtensionFromPath(string $path): string
    {
        $type = $this->getTypeFromMimeType($path);

        if (!$type) {
            throw new InvalidFileTypeException();
        }

        return strtolower($type);
    }

    /**
     * @param string $path
     * @return string
     * @throws InvalidFileTypeException
     */
    private function getOldFileExtensionFromPath(string $path): string
    {
        $type = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        $type = $type === 'jpg' ? FileType::JPEG : $type;

        if (!$type || !$this->isValidType($type)) {
            throw new InvalidFileTypeException();
        }

        return strtolower($type);
    }

    private function getTypeFromMimeType(string $path): ?string
    {
        // Use finfo to get the MIME type of the file
        $finfo = finfo_open(FILEINFO_MIME_TYPE);

        if (!$finfo) {
            return null;
        }

        $mimeType = finfo_file($finfo, $path);
        finfo_close($finfo);

        $mimeTypes = [
            'image/jpeg' => 'jpeg',
            'image/png' => 'png',
            'image/gif' => 'gif',
        ];

        return $mimeTypes[$mimeType] ?? null;
    }

    /**
     * @param string $type
     * @return bool
     */
    private function isValidType(string $type): bool
    {
        return in_array($type, FileType::getAvailableTypes());
    }
}
