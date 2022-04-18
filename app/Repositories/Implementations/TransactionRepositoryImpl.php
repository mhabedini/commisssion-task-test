<?php

namespace App\Repositories\Implementations;

use App\Helpers\Csv;
use App\Repositories\TransactionRepository;

class TransactionRepositoryImpl implements TransactionRepository
{
    public const HEADER = [
        'date',
        'user_id',
        'user_type',
        'operation_type',
        'amount',
        'currency',
    ];

    public function createFromPath($path)
    {
        return Csv::createFromPath(public_path('input.csv'))
            ->setHeader(self::HEADER)
            ->toArray();
    }

    public function createFromFile($path)
    {
        return Csv::createFromPath(public_path('input.csv'))
            ->setHeader(self::HEADER)
            ->toArray();
    }
}
