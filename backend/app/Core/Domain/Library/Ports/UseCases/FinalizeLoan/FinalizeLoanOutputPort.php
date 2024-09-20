<?php

namespace App\Core\Domain\Library\Ports\UseCases\FinalizeLoan;

use App\Core\Common\Ports\ViewModel;

interface FinalizeLoanOutputPort
{
    public function present(FinalizeLoanResponseModel $responseModel): ViewModel;
}