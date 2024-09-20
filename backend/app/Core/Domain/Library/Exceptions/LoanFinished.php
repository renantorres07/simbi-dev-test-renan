<?php

namespace App\Core\Domain\Library\Exceptions;

use DomainException;
use DateTime;

class LoanFinished extends DomainException
{
    public DateTime $returnedAt;
    public function __construct(DateTime $returnedAt)
    {
        parent::__construct("Loan finished " . $returnedAt->format('Y-m-d H:i:s') . '.');
        $this->returnedAt = $returnedAt;
    }
}