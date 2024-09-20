<?php

namespace App\Core\Domain\Library\Exceptions;

use DomainException;

class LoanMustHaveABook extends DomainException
{
    protected $message = 'Loan must have a book!';
}