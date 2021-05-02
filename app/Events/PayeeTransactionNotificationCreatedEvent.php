<?php

namespace App\Events;

use App\Models\PayeeTransactionNotification;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PayeeTransactionNotificationCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public PayeeTransactionNotification $payeeTransactionNotification;

    /**
     * Create a new event instance.
     *
     * @param  PayeeTransactionNotification  $payeeTransactionNotification
     */
    public function __construct(
        PayeeTransactionNotification $payeeTransactionNotification
    ) {
        $this->payeeTransactionNotification = $payeeTransactionNotification;
    }
}
