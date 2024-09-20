<?php

namespace App\Core\Domain\Library\Ports\Persistence;

use App\Core\Domain\Library\Entities\Loan;

interface LoanRepository
{
    public function create(Loan $loan): Loan;

    public function getAll(): array;
}