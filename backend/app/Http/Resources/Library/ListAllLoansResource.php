<?php

namespace App\Http\Resources\Library;

use App\Core\Domain\Library\Entities\Loan;
use DateTime;
use Illuminate\Http\Resources\Json\JsonResource;

class ListAllLoansResource extends JsonResource
{
    public function __construct(private Loan $loan)
    {
    }

    public function toArray($request = null)
    {
        return [
            'id' => $this->loan->id,
            'book' => (new BookDetailsResource($this->loan->book))->resolve(),
            'loanDate' => $this->loan->loanDate->format(DateTime::ATOM),
            'returnDate' => $this->loan->returnDate->format(DateTime::ATOM),
            'status' => $this->loan->status,
            'renewalCount' => $this->loan->renewalCount,
            'lastRenewedAt' => $this->loan->lastRenewDate ? $this->loan->lastRenewDate->format(DateTime::ATOM) : null,
            'returnedAt' => $this->loan->returnedAt ? $this->loan->returnedAt->format(DateTime::ATOM) : null,
            'createdAt' => $this->loan->createdAt->format(DateTime::ATOM),
            'updatedAt' => $this->loan->updatedAt->format(DateTime::ATOM),
        ];
    }
}