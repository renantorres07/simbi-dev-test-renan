<?php

namespace App\Core\Domain\Library\Ports\UseCases\FinalizeLoan;

final class FinalizeLoanRequestModel
{
    public function __construct(private array $attributes = [])
    {
    }

    public function getLoanId(): string|null
    {
        return $this->attributes['loanId'] ?? null;
    }
}