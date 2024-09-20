<?php

namespace App\Core\Services\Library;

use App\Core\Common\Ports\ViewModel;
use App\Core\Domain\Library\Entities\Loan;
use App\Core\Domain\Library\Exceptions\LoanAlreadyHaveFinished;
use App\Core\Domain\Library\Exceptions\LoanIdIsRequired;
use App\Core\Domain\Library\Ports\Persistence\LoanRepository;
use App\Core\Domain\Library\Ports\UseCases\FinalizeLoan\{
    FinalizeLoanOutputPort,
    FinalizeLoanRequestModel,
    FinalizeLoanResponseModel,
    FinalizeLoanUseCase,
};
use DateTime;

final class FinalizeLoanService implements FinalizeLoanUseCase
{
    public function __construct(private FinalizeLoanOutputPort $output, private LoanRepository $loanRepository)
    {
    }

    public function execute(FinalizeLoanRequestModel $requestModel): ViewModel
    {
        $this->validate($requestModel);
        $id = $requestModel->getLoanId();
        $loan = $this->loanRepository->findById($id);
        $this->validateLoanStatus($loan);
        $status = 'finished';
        $returnedAt = new DateTime();
        $loan = $this->loanRepository->finalize($id, $status, $returnedAt);
        return $this->output->present(new FinalizeLoanResponseModel($loan));
    }

    private function validate(FinalizeLoanRequestModel $requestModel): void
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