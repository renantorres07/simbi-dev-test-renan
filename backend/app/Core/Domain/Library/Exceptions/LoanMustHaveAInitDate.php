<?php

namespace App\Core\Domain\Library\Exceptions;

use DomainException;

class LoanMustHaveAInitDate extends DomainException
{
    protected $message = "Loan must have a init date (loanDate)!";
}