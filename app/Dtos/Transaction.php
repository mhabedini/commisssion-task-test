<?php

namespace App\Dtos;


use Spatie\DataTransferObject\DataTransferObject;


class Transaction extends DataTransferObject
{
    public const TYPE_DEPOSIT = 'deposit';

    public const TYPE_WITHDRAW = 'withdraw';

    public string $date;

    public int $user_id;

    public string $user_type;

    public string $operation_type;

    public string $amount;

    public string $currency;
}
