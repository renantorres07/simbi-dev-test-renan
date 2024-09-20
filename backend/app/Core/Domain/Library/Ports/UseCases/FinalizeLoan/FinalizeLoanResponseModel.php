<?php

namespace App\Core\Domain\Library\Ports\UseCases\FinalizeLoan;

use App\Core\Domain\Library\Entities\Loan;

final class FinalizeLoanResponseModel
{
    public function __construct(private Loan $loan)
    {
    }

    public function getLoan(): Loan
    {
        return $this->loan;
    }
}