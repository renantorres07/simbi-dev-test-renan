<?php

namespace App\Core\Services\Library;

use App\Core\Common\Ports\ViewModel;
use App\Core\Domain\Library\Entities\Loan;
use App\Core\Domain\Library\Exceptions\LoanAlreadyHaveFinished;
use App\Core\Domain\Library\Exceptions\LoanIdIsRequired;
use App\Core\Domain\Library\Ports\Persistence\LoanRepository;
use App\Core\Domain\Library\Ports\UseCases\RenewLoan\{
    RenewLoanOutputPort,
    RenewLoanRequestModel,
    RenewLoanResponseModel,
    RenewLoanUseCase,
};
use DateTime;

final class RenewLoanService implements RenewLoanUseCase
{
    public function __construct(private RenewLoanOutputPort $output, private LoanRepository $loanRepository)
    {
    }

    public function execute(RenewLoanRequestModel $requestModel): ViewModel
    {
        $this->validate($requestModel);
        $id = $requestModel->getLoanId();
        $loan = $this->loanRepository->findById($id);
        $this->validateLoanStatus($loan);
        $status = 'active';
        $lastRenewedAt = new DateTime();
        $returnDate = (clone $lastRenewedAt)->modify('+7 days');
        $loan = $this->loanRepository->renew($id, $status, $lastRenewedAt, $returnDate);
        return $this->output->present(new RenewLoanResponseModel($loan));
    }

    private function validate(RenewLoanRequestModel $requestModel): void
    {
        if (empty($requestModel->getLoanId())) {
            throw new LoanIdIsRequired();
        }
    }

    private function validateLoanStatus(Loan $loan): void
    {
        if ($loan->status === 'finished') {
            throw new LoanAlreadyHaveFinished($loan->returnedAt);
        }
    }
}