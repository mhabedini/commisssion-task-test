<?php

namespace Tests\Feature;

use App\Repositories\TransactionRepository;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class TransactionControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        Http::fake([
            'https://developers.paysera.com/tasks/api/currency-exchange-rates' => [
                "base" => "EUR",
                "date" => "2022-04-15",
                "rates" => [
                    "JPY" => 129.53,
                    "EUR" => 1,
                    "USD" => 1.1497
                ]
            ],
        ]);

        $transactions = app()->make(TransactionRepository::class)->createFromPath('input.csv');

        $response = $this->withHeader('accept', 'application/json')
            ->post('api/transactions', ['transactions' => $transactions]);

        $response->assertStatus(200);
        $response->assertJson([
            0.60,
            3.00,
            0.00,
            0.06,
            1.50,
            0,
            0.70,
            0.30,
            0.30,
            3.00,
            0.00,
            0.00,
            8612,
        ]);
    }
}
