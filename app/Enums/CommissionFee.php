<?php

namespace App\Enums;

enum CommissionFee
{
    const Deposit = 0.03 / 100;
    const PrivateWithdraw = 0.3 / 100;
    const BusinessWithdraw = 0.5 / 100;
    const WeeklyCommissionFreeWithdrawInEuro = 1000;
}
