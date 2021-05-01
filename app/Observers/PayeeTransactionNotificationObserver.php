<?php

namespace App\Observers;

use App\Events\PayeeTransactionNotificationCreatedEvent;
use App\Models\PayeeTransactionNotification;

class PayeeTransactionNotificationObserver
{
    /**
     * Handle the PayeeTransactionNotification "created" event.
     *
     * @param  \App\Models\PayeeTransactionNotification  $payeeTransactionNotification
     *
     * @return void
     */
    public function created(
        PayeeTransactionNotification $payeeTransactionNotification
    ) {
        PayeeTransactionNotificationCreatedEvent::dispatch(
            $payeeTransactionNotification
        );
    }
}
