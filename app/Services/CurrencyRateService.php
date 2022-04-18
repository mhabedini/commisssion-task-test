<?php

namespace App\Services;

use App\Exceptions\UnsupportedCurrencyException;
use App\Repositories\CurrencyExchangeRateRepository;

class CurrencyRateService
{
    public static function exchangeRates()
    {
        return app()->make(CurrencyExchangeRateRepository::class)->index();
    }

    /**
     * @throws UnsupportedCurrencyException
     */
    public static function convertCurrencyToEuro($value, $currency): float|int
    {
        $rates = self::exchangeRates();
        if (!array_key_exists($currency, $rates)) {
            throw new UnsupportedCurrencyException();
        }
        return $value / $rates[$currency];
    }
}
