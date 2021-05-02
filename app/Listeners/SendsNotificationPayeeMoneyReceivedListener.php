<?php

namespace App\Listeners;

use App\Events\PayeeTransactionNotificationCreatedEvent;
use App\Services\SendsNotificationPayeeMoneyReceivedService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendsNotificationPayeeMoneyReceivedListener implements ShouldQueue
{
    use InteractsWithQueue;

    private SendsNotificationPayeeMoneyReceivedService $sendsNotificationPayeeMoneyReceivedService;

    /**
     * Create the event listener.
     *
     * @param  SendsNotificationPayeeMoneyReceivedService  $sendsNotificationPayeeMoneyReceivedService
     */
    public function __construct(
        SendsNotificationPayeeMoneyReceivedService $sendsNotificationPayeeMoneyReceivedService
    ) {
        $this->sendsNotificationPayeeMoneyReceivedService
            = $sendsNotificationPayeeMoneyReceivedService;
    }

    /**
     * Handle the event.
     *
     * @param  PayeeTransactionNotificationCreatedEvent  $event
     *
     * @return void
     */
    public function handle(PayeeTransactionNotificationCreatedEvent $event)
    {
        $this->sendsNotificationPayeeMoneyReceivedService->notify(
            $event->payeeTransactionNotification
        );
    }
}
