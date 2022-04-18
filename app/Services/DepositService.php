<?php

namespace App\Services;

use App\Enums\CommissionFee;

class DepositService extends FinanceOperation
{
    protected function calculateCommission(): float|int
    {
        return $this->transaction->amount * CommissionFee::Deposit;
    }
}
