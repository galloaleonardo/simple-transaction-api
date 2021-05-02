<?php

namespace App\Listeners;

use App\Events\TransactionReceivedEvent;
use App\Services\TransactionService;

class FinishesTransactionListener
{
    private TransactionService $transactionService;

    /**
     * Create the event listener.
     *
     * @param  TransactionService  $transactionService
     */
    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * Handle the event.
     *
     * @param  TransactionReceivedEvent  $event
     *
     * @return void
     */
    public function handle(TransactionReceivedEvent $event)
    {
        $this->transactionService->setFinished($event->transaction);
    }
}
