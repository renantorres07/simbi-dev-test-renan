<?php

namespace App\Core\Domain\Library\Ports\UseCases\RenewLoan;

final class RenewLoanRequestModel
{
    public function __construct(private array $attributes = [])
    {
    }

    public function getLoanId(): string|null
    {
        return $this->attributes['loanId'] ?? null;
    }
}