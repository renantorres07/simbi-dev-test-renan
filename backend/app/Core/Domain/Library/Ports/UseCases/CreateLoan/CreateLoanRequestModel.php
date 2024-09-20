<?php

namespace App\Core\Domain\Library\Ports\UseCases\CreateLoan;

final class CreateLoanRequestModel
{
    public function __construct(private array $attributes = [])
    {
    }

    public function getBookId(): string|null
    {
        return $this->attributes['bookId'] ?? null;
    }

    public function getLoanDate(): string|null
    {
        return $this->attributes['loanDate'] ?? null;
    }

    public function getReturnDate(): string|null
    {
        return $this->attributes['returnDate'] ?? null;
    }
}