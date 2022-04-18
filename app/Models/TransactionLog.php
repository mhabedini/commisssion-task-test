<?php

namespace App\Models;

use App\Services\CurrencyRateService;
use Illuminate\Support\Carbon;

class TransactionLog extends Model
{
    public static function userWithdrawAmountForGivenDateWeek($userId, $date)
    {
        $userBalances = self::all();

        $startOfWeekDate = Carbon::parse($date)->floorWeek()->format('Y-m-d');
        $endOfWeekDate = Carbon::parse($date)->ceilWeek()->format('Y-m-d');

        return $userBalances->where('operation_type', 'withdraw')
            ->where('user_id', $userId)
            ->whereBetween('date', [$startOfWeekDate, $endOfWeekDate])
            ->sum(function ($item) {
                return CurrencyRateService::convertCurrencyToEuro($item['amount'], $item['currency']);
            });
    }
}
