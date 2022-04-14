<?php

namespace App\Exceptions;

class InsufficientAmountException extends \Exception
{
    protected $message = 'Insufficient amount is given';
}