<?php

namespace App\Services;

use App\Dtos\Transaction;
use App\Exceptions\WrongFinanceTypeException;

class Finance
{
    /**
     * @throws WrongFinanceTypeException
     */
    public static function make(Transaction $transaction): FinanceOperation
    {
        return match ($transaction->operation_type) {
            Transaction::TYPE_DEPOSIT => (new DepositService($transaction)),
            Transaction::TYPE_WITHDRAW => (new WithdrawService($transaction)),
            default => throw new WrongFinanceTypeException(),
        };
    }
}
