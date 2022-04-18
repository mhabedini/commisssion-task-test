<?php

namespace App\Http\Requests;

use App\Services\CurrencyRateService;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed $transactions
 */
class StoreTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'transactions' => 'array',
            'transactions.*.date' => 'required|date|date_format:Y-m-d',
            'transactions.*.user_id' => 'required|integer',
            'transactions.*.user_type' => 'required|string|in:private,business',
            'transactions.*.operation_type' => 'required|string|in:deposit,withdraw',
            'transactions.*.amount' => 'required|numeric',
            'transactions.*.currency' => 'required|string|in:' . implode(
                    ',',
                    array_keys(CurrencyRateService::exchangeRates())
                ),
        ];
    }
}
