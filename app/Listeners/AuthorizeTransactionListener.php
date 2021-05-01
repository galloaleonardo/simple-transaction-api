<?php

namespace App\Listeners;

use App\Events\TransactionCreatedEvent;
use App\Services\AuthorizeTransactionService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AuthorizeTransactionListener implements ShouldQueue
{
    use InteractsWithQueue;

    private AuthorizeTransactionService $authorizeTransactionService;

    /**
     * Create the event listener.
     *
     * @param  AuthorizeTransactionService  $authorizeTransactionService
     */
    public function __construct(
        AuthorizeTransactionService $authorizeTransactionService
    ) {
        $this->authorizeTransactionService = $authorizeTransactionService;
    }

    /**
     * Handle the event.
     *
     * @param  TransactionCreatedEvent  $event
     *
     * @return void
     */
    public function handle(TransactionCreatedEvent $event)
    {
        $this->authorizeTransactionService->authorize(
            $event->transaction
        );
    }
}
