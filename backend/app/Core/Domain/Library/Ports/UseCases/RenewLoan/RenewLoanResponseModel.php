<?php

namespace App\Core\Domain\Library\Ports\UseCases\RenewLoan;

use App\Core\Domain\Library\Entities\Loan;

final class RenewLoanResponseModel
{
    public function __construct(private Loan $loan)
    {
    }

    public function getLoan(): Loan
    {
        return $this->loan;
    }
}