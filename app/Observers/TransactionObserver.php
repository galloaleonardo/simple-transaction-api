<?php

namespace App\Observers;

use App\Events\TransactionCreatedEvent;
use App\Models\Transaction;
use App\Models\Wallet;
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
            //
        }

        if ($transaction->cancelled()) {
            $this->walletService->returnsPayerBalance($transaction);
        }
    }

    /**
     * Handle the Transaction "deleted" event.
     *
     * @param  \App\Models\Transaction  $transaction
     *
     * @return void
     */
    public function deleted(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "restored" event.
     *
     * @param  \App\Models\Transaction  $transaction
     *
     * @return void
     */
    public function restored(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "force deleted" event.
     *
     * @param  \App\Models\Transaction  $transaction
     *
     * @return void
     */
    public function forceDeleted(Transaction $transaction)
    {
        //
    }
}
