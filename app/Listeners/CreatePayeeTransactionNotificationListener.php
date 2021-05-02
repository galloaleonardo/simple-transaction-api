<?php

namespace App\Listeners;

use App\Events\TransactionReceivedEvent;
use App\Services\PayeeTransactionNotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreatePayeeTransactionNotificationListener implements ShouldQueue
{
    use InteractsWithQueue;

    private PayeeTransactionNotificationService $payeeTransactionNotificationService;

    /**
     * Create the event listener.
     *
     * @param  PayeeTransactionNotificationService  $payeeTransactionNotificationService
     */
    public function __construct(
        PayeeTransactionNotificationService $payeeTransactionNotificationService
    ) {
        $this->payeeTransactionNotificationService
            = $payeeTransactionNotificationService;
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
        $this->payeeTransactionNotificationService->save($event->transaction);
    }
}
