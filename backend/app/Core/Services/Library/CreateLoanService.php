<?php

namespace App\Core\Services\Library;

use App\Core\Common\Ports\ViewModel;
use App\Core\Domain\Library\Entities\Loan;
use App\Core\Domain\Library\Exceptions\LoanMustHaveABook;
use App\Core\Domain\Library\Ports\Persistence\LoanRepository;
use App\Core\Domain\Library\Ports\UseCases\CreateLoan\{
    CreateLoanOutputPort,
    CreateLoanRequestModel,
    CreateLoanResponseModel,
    CreateLoanUseCase,
};

use DateTime;

final class CreateLoanService implements CreateLoanUseCase
{
    private ?DateTime $loanDate;

    private ?DateTime $returnDate;

    public function __construct(private CreateLoanOutputPort $output, private LoanRepository $loanRepository)
    {
        $this->loanDate = null;
        $this->returnDate = null;
    }

    public function execute(CreateLoanRequestModel $requestModel): ViewModel
    {
        $this->validate($requestModel);
        $this->checkLoanDate($requestModel);
        $this->checkReturnDate($requestModel);
        $loan = $this->loanRepository->create(new Loan(
            bookId: $requestModel->getBookId(),
            loanDate: $this->loanDate,
            returnDate: $this->returnDate,
        ));
        return $this->output->present(new CreateLoanResponseModel($loan));
    }

    private function validate(CreateLoanRequestModel $requestModel): void
    {
        if (empty($requestModel->getBookId())) {
            throw new LoanMustHaveABook();
        }
    }

    private function checkLoanDate(CreateLoanRequestModel $requestModel): void
    {
        if (empty($requestModel->getLoanDate())) {
            $now = new DateTime();
            $this->loanDate = $now;
        } else {
            $this->loanDate = new DateTime($requestModel->getLoanDate());
        }
    }

    private function checkReturnDate(CreateLoanRequestModel $requestModel): void
    {
        if (empty($requestModel->getReturnDate())) {
            $this->returnDate = (clone $this->loanDate)->modify("+7 days");
        } else {
            $this->returnDate = new DateTime($requestModel->getReturnDate());
        }
    }
}