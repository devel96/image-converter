<?php

declare(strict_types=1);

namespace Devel96\Converter\Exceptions;

use Exception;

class InvalidFileException extends Exception
{
    protected $message = 'This file does not exist';
}