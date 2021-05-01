<?php

namespace App\Listeners;

use App\Events\TransactionAuthorizedEvent;
use App\Services\ReceiveTransactionService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddPayeeBalanceListener implements ShouldQueue
{
    use InteractsWithQueue;

    private ReceiveTransactionService $receiveTransactionService;

    /**
     * Create the event listener.
     *
     * @param  ReceiveTransactionService  $receiveTransactionService
     */
    public function __construct(
        ReceiveTransactionService $receiveTransactionService
    ) {
        $this->receiveTransactionService = $receiveTransactionService;
    }

    /**
     * Handle the event.
     *
     * @param  TransactionAuthorizedEvent  $event
     *
     * @return void
     */
    public function handle(TransactionAuthorizedEvent $event)
    {
        $this->receiveTransactionService->receive($event->transaction);
    }
}
