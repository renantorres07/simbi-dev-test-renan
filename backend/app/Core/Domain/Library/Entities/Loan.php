<?php

namespace App\Core\Domain\Library\Entities;

use App\Core\Common\Entities\Entity;
use App\Core\Common\Traits\{WithCreatedAt, WithUpdatedAt};
use App\Core\Domain\Library\Exceptions\{LoanMustHaveAInitDate, LoanMustHaveAReturnDate, LoanMustHaveABook};

use DateTime;

class Loan extends Entity
{
    use WithCreatedAt, WithUpdatedAt;

    public ?string $bookId;

    public ?DateTime $loanDate;

    public ?DateTime $returnDate;

    public ?DateTime $returnedAt;

    public string $status;

    public ?Book $book;

    public int $renewalCount;

    public ?DateTime $lastRenewDate;

    const STATUS_CREATED = "created";
    const STATUS_ACTIVE = "active";
    const STATUS_FINISHED = "finished";
    const STATUS_OVERDUE = "overdue";

    public function __construct(
        ?string $id = null,
        ?string $bookId = null,
        ?DateTime $returnDate = null,
        ?DateTime $returnedAt = null,
        ?DateTime $loanDate = null,
        ?string $status = self::STATUS_CREATED,
        ?int $renewalCount = 0,
        ?DateTime $lastRenewDate = null,
        ?DateTime $createdAt = null,
        ?DateTime $updateAt = null,
    ) {
        parent::__construct($id);
        $this->bookId = $bookId;
        $this->returnDate = $returnDate;
        $this->returnedAt = $returnedAt;
        $this->loanDate = $loanDate ?? new DateTime();
        $this->status = $status;
        $this->renewalCount = $renewalCount;
        $this->lastRenewDate = $lastRenewDate;
        $this->createdAt = $createdAt ?? new DateTime();
        $this->updatedAt = $updateAt;
    }

    public function addBook(Book $book): void
    {
        $this->book = $book;
    }

    public function validate(): void
    {
        $currentDate = new DateTime();
        if (empty($this->bookId)) {
            throw new LoanMustHaveABook();
        }
        if (empty($this->returnDate)) {
            throw new LoanMustHaveAReturnDate();
        }
        if (empty($this->returnedAt)) {
            if ($this->returnDate < $currentDate) {
                $this->status = self::STATUS_OVERDUE;
            } else {
                $this->status = self::STATUS_ACTIVE;
            }
        } else {
            $this->status = self::STATUS_FINISHED;
        }
        $this->updatedAt = new DateTime();
    }
}