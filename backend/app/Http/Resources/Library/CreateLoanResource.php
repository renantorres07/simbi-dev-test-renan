<?php
namespace App\Http\Resources\Library;

use App\Core\Domain\Library\Entities\Loan;
use DateTimeInterface;
use Illuminate\Http\Resources\Json\JsonResource;

final class CreateLoanResource extends JsonResource
{
    public function __construct(private Loan $loan)
    {
    }

    public function toArray($request = null)
    {
        return [
            'id' => $this->loan->id,
            'loanDate' => $this->loan->loanDate->format(DateTimeInterface::ATOM),
            'returnDate' => $this->loan->returnDate->format(DateTimeInterface::ATOM),
            'status' => $this->loan->status,
            'book' => (new BookDetailsResource($this->loan->book))->resolve(),
            'createdAt' => $this->loan->createdAt->format(DateTimeInterface::ATOM),
            'updatedAt' => $this->loan->updatedAt->format(DateTimeInterface::ATOM),
        ];
    }
}