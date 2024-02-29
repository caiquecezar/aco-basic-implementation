<?php

namespace App\Exceptions;

use Exception;

class InvalidPlayerQuantityException extends Exception
{
    public const ERROR_MESSAGE = 'Invalid number of players to create.';

    public function __construct()
    {
        parent::__construct(self::ERROR_MESSAGE);
    }
}