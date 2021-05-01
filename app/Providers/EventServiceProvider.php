<?php

namespace App\Providers;

use App\Events\PayeeTransactionNotificationCreatedEvent;
use App\Events\TransactionAuthorizedEvent;
use App\Events\TransactionCreatedEvent;
use App\Events\TransactionReceivedEvent;
use App\Listeners\AddPayeeBalanceListener;
use App\Listeners\AuthorizeTransactionListener;
use App\Listeners\CreatePayeeTransactionNotificationListener;
use App\Listeners\FinishesTransactionListener;
use App\Listeners\SendsNotificationPayeeMoneyReceivedListener;
use App\Models\PayeeTransactionNotification;
use App\Models\Transaction;
use App\Observers\PayeeTransactionNotificationObserver;
use App\Observers\TransactionObserver;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

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
        ],
        TransactionAuthorizedEvent::class => [
            AddPayeeBalanceListener::class,
        ],
        TransactionReceivedEvent::class => [
            FinishesTransactionListener::class,
            CreatePayeeTransactionNotificationListener::class,
        ],
        PayeeTransactionNotificationCreatedEvent::class => [
            SendsNotificationPayeeMoneyReceivedListener::class
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
        PayeeTransactionNotification::observe(
            PayeeTransactionNotificationObserver::class
        );
    }
}
