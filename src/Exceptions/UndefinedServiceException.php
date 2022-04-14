<?php

namespace App\Exceptions;

class UndefinedServiceException extends \Exception
{
    protected $message = 'No instance for service';
}