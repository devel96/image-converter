<?php

declare(strict_types=1);

namespace Devel96\Converter\Exceptions;

use Exception;

class InvalidFileTypeException extends Exception
{
    protected $message = 'This file type is not supported';
}