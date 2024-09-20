<?php

namespace App\Core\Domain\Library\Exceptions;

use DomainException;

class InvalidLoan extends DomainException
{
    public function __construct(?string $message = '')
    {
        parent::__construct('Invalid Loan.' . $message);
    }
}