<?php

declare(strict_types=1);

namespace Devel96\Converter\Exceptions;

use Exception;

class InvalidPathException extends Exception
{
    protected $message = 'This path does not exist';
}