<?php

namespace App\Services;

use App\Models\PayeeTransactionNotification;
use Illuminate\Support\Facades\Http;

class SendsNotificationPayeeMoneyReceivedService
{
    private const SENT_MESSAGE = 'Enviado';
    private const NOTIFICATION_URL
        = 'https://run.mocky.io/v3/b19f7b9f-9cbf-4fc6-ad22-dc30601aec04';

    protected PayeeTransactionNotificationService $payeeTransactionNotificationService;

    public function __construct(
        PayeeTransactionNotificationService $payeeTransactionNotificationService
    ) {
        $this->payeeTransactionNotificationService
            = $payeeTransactionNotificationService;
    }

    public function notify(PayeeTransactionNotification $transaction): void
    {
        try {
            $response = Http::get(self::NOTIFICATION_URL);

            if ($response->failed()) {
                $this->payeeTransactionNotificationService->setNotSent(
                    $transaction
                );
                return;
            }

            if ($response->json()['message'] === self::SENT_MESSAGE) {
                $this->payeeTransactionNotificationService->setSent($transaction);
                return;
            }
        } catch (\Exception $e) {
            $this->payeeTransactionNotificationService->setNotSent($transaction);
            return;
        }

        $this->payeeTransactionNotificationService->setNotSent($transaction);
    }
}
