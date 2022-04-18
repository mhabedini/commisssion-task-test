<?php

namespace App\Http\Controllers;

use App\Dtos\Transaction;
use App\Http\Requests\StoreTransactionRequest;
use App\Models\TransactionLog;
use App\Repositories\TransactionRepository;
use App\Services\Finance;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CommissionFeeController extends Controller
{
    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Exception
     */
    public function store(StoreTransactionRequest $request): JsonResponse
    {
        $transactions = $request->transactions;
        $this->transact($transactions);
        return response()->json(TransactionLog::all()->pluck('commission'));
    }

    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     * @throws \App\Exceptions\WrongFinanceTypeException
     */
    private function transact($transactions)
    {
        foreach ($transactions as $transaction) {
            $transaction = new Transaction($transaction);
            $commission = Finance::make($transaction)->getCommission();
            TransactionLog::create(Arr::add($transaction->toArray(), 'commission', $commission));
        }
    }

    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     * @throws \App\Exceptions\WrongFinanceTypeException
     */
    public function storeWeb(Request $request): Factory|View|Application
    {
        if ($request->hasFile('transactions')) {
            $file = $request->file('transactions')->openFile();
            $transactions = app()->make(TransactionRepository::class)->createFromFile($file);
            $this->transact($transactions);
        }
        $commissions = TransactionLog::all();
        return view('result')->with(['commissions' => $commissions]);
    }

    public function create()
    {
        return view('create');
    }
}
