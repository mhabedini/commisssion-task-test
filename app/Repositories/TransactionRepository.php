<?php

namespace App\Repositories;

interface TransactionRepository
{
    public function createFromPath($path);
    public function createFromFile($path);
}
