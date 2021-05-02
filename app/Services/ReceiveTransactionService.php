<?php

namespace App\Services;

use App\Models\Transaction;
use Illuminate\Support\Facades\Http;

class ReceiveTransactionService
{
    protected WalletService $walletService;
    protected TransactionService $transactionService;

    public function __construct(
        WalletService $walletService,
        TransactionService $transactionService
    ) {
        $this->walletService = $walletService;
        $this->transactionService = $transactionService;
    }

    public function receive(Transaction $transaction): void
    {
        try {
            if ($received = $this->walletService->addPayeeBalance($transaction)) {
                $this->transactionService->setReceived($transaction);
                return;
            }
        } catch (\Exception $e) {
            $this->transactionService->setCancelled($transaction);
            return;
        }

        $this->transactionService->setCancelled($transaction);
    }
}
