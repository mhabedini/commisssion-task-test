<?php

namespace App\Services;

use App\Dtos\Transaction;
use App\Enums\CommissionFee;
use App\Enums\UserType;
use App\Exceptions\WrongUserTypeException;
use App\Models\TransactionLog;

class WithdrawService extends FinanceOperation
{
    /**
     * @throws WrongUserTypeException
     */
    function calculateCommission(): float|int
    {
        return match ($this->transaction->user_type) {
            UserType::Business => $this->calculateBusinessWithdrawCommissionFee($this->transaction),
            UserType::Private => $this->calculatePrivateWithdrawCommissionFee($this->transaction),
            default => throw new WrongUserTypeException(),
        };
    }

    function calculateBusinessWithdrawCommissionFee(Transaction $transaction): float
    {
        return $transaction->amount * CommissionFee::BusinessWithdraw;
    }

    function calculatePrivateWithdrawCommissionFee(Transaction $transaction): float|int
    {
        // Check how much the user withdrew in this transaction's current week
        $withdrawAmountForWeekOfGivenDate = TransactionLog::userWithdrawAmountForGivenDateWeek(
            $transaction->user_id,
            $transaction->date
        );

        // Check if user is not allowed to withdraw, free of charge
        if ($withdrawAmountForWeekOfGivenDate >= CommissionFee::WeeklyCommissionFreeWithdrawInEuro) {
            return $transaction->amount * CommissionFee::PrivateWithdraw;
        }

        $transactionCurrencyRate = CurrencyRateService::exchangeRates()[$transaction->currency];

        // Get how much money user can withdraw, free of charge
        $freeAmount = (CommissionFee::WeeklyCommissionFreeWithdrawInEuro - $withdrawAmountForWeekOfGivenDate) * $transactionCurrencyRate;

        if ($transaction->amount - $freeAmount > 0) {
            // Withdraw is partially free
            $fee = ($transaction->amount - $freeAmount) * CommissionFee::PrivateWithdraw;
        } else {
            // Withdraw is free
            $fee = 0;
        }
        return $fee;
    }
}
