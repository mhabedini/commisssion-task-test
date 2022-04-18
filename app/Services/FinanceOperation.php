<?php

namespace App\Services;

use App\Dtos\Transaction;

abstract class FinanceOperation
{
    protected Transaction $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    protected abstract function calculateCommission();

    public function getCommission(): string
    {
        $commission = $this->calculateCommission();
        $precision = calculate_number_precision($this->transaction->amount);
        $commission = round_up_number($commission, $precision);
        return format_number($commission, $precision);
    }
}
