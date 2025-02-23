<?php

namespace App\Exceptions;

use Exception;

class HttpException extends Exception
{
    public function __construct(
        string $message,
        int $code = 500
    ) {
        parent::__construct($message, $code);
    }
}
