<?php

namespace App\Repositories\Implementations;

use App\Repositories\CurrencyExchangeRateRepository;
use Illuminate\Support\Facades\Http;

class CurrencyExchangeRateRepositoryImpl implements CurrencyExchangeRateRepository
{

    private const EXCHANGE_RATE_API = 'https://developers.paysera.com/tasks/api/currency-exchange-rates';
    private ?array $rates = null;

    public function index()
    {
        if (is_null($this->rates)) {
            $rates = Http::get(self::EXCHANGE_RATE_API)->throw()->collect();
            $this->rates = $rates['rates'];
        }
        return $this->rates;
    }
}
