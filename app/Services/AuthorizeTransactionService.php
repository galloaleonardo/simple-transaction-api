<?php

namespace App\Services;

use App\Models\Transaction;
use Illuminate\Support\Facades\Http;

class AuthorizeTransactionService
{
    private const AUTHORIZED_MESSAGE = 'Autorizado';
    private const AUTHORIZATION_URL
        = 'https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6';

    protected TransactionService $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function authorize(Transaction $transaction): void
    {
        $response = Http::get(self::AUTHORIZATION_URL);

        if ($response->failed()) {
            $this->transactionService->setCancelled($transaction);
            return;
        }

        if ($response->json()['message'] === self::AUTHORIZED_MESSAGE)
        {
            $this->transactionService->setAuthorized($transaction);
            return;
        }

        $this->transactionService->setCancelled($transaction);
    }
}
