<?php

namespace App\Providers;

use App\Repositories\CurrencyExchangeRateRepository;
use App\Repositories\Implementations\CurrencyExchangeRateRepositoryImpl;
use App\Repositories\Implementations\TransactionRepositoryImpl;
use App\Repositories\TransactionRepository;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CurrencyExchangeRateRepository::class, CurrencyExchangeRateRepositoryImpl::class);
        $this->app->bind(TransactionRepository::class, TransactionRepositoryImpl::class);
    }


    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [TransactionRepository::class, CurrencyExchangeRateRepositoryImpl::Class];
    }
}
