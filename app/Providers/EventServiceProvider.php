<?php

namespace App\Providers;

use App\Events\TransactionCancelledEvent;
use App\Events\TransactionCreatedEvent;
use App\Listeners\AuthorizeTransactionListener;
use App\Listeners\ReturnsBalanceToWalletListener;
use App\Models\Transaction;
use App\Observers\TransactionObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        TransactionCreatedEvent::class => [
            AuthorizeTransactionListener::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Transaction::observe(TransactionObserver::class);
    }
}
