<?php

namespace App\Observers;

use App\Events\TransactionAuthorizedEvent;
use App\Events\TransactionCreatedEvent;
use App\Events\TransactionReceivedEvent;
use App\Models\Transaction;
use App\Services\WalletService;

class TransactionObserver
{
    private WalletService $walletService;

    public function __construct(WalletService $walletService)
    {
        $this->walletService = $walletService;
    }

    /**
     * Handle the Transaction "created" event.
     *
     * @param  \App\Models\Transaction  $transaction
     *
     * @return void
     */
    public function created(Transaction $transaction)
    {
        $this->walletService->subtractPayerBalance($transaction);

        TransactionCreatedEvent::dispatch($transaction);
    }

    /**
     * Handle the Transaction "updated" event.
     *
     * @param  \App\Models\Transaction  $transaction
     *
     * @return void
     */
    public function updated(Transaction $transaction)
    {
        if ($transaction->authorized()) {
            TransactionAuthorizedEvent::dispatch($transaction);
        }

        if ($transaction->cancelled()) {
            $this->walletService->returnsPayerBalance($transaction);
        }

        if ($transaction->received()) {
            TransactionReceivedEvent::dispatch($transaction);
        }
    }
}
