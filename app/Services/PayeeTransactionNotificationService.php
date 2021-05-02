<?php

namespace App\Services;

use App\Models\PayeeTransactionNotification;
use App\Models\Transaction;
use App\Repositories\PayeeTransactionNotificationRepository;

class PayeeTransactionNotificationService
{
    protected PayeeTransactionNotificationRepository $payeeTransactionNotificationRepository;

    public function __construct(
        PayeeTransactionNotificationRepository $payeeTransactionNotificationRepository
    ) {
        $this->payeeTransactionNotificationRepository
            = $payeeTransactionNotificationRepository;
    }

    public function save(Transaction $transaction)
    {
        $this->payeeTransactionNotificationRepository->save(
            $transaction->payee_id
        );
    }

    public function setSent(
        PayeeTransactionNotification $payeeTransactionNotification
    ) {
        $this->payeeTransactionNotificationRepository->setSent(
            $payeeTransactionNotification->id
        );
    }

    public function setNotSent(
        PayeeTransactionNotification $payeeTransactionNotification
    ) {
        $this->payeeTransactionNotificationRepository->setNotSent(
            $payeeTransactionNotification->id
        );
    }
}
