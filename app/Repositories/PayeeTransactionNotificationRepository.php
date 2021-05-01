<?php

namespace App\Repositories;

use App\Models\PayeeTransactionNotification;

class PayeeTransactionNotificationRepository
{
    protected PayeeTransactionNotification $model;

    public function __construct(PayeeTransactionNotification $model)
    {
        $this->model = $model;
    }

    public function save(int $payeeId): void
    {
        $this->model->user_id = $payeeId;
        $this->model->status = $this->model::PENDING;

        $this->model->save();
    }

    public function setSent(int $id)
    {
        $notification = $this->model->findOrFail($id);
        $notification->status = $this->model::SENT;

        $notification->save();
    }

    public function setNotSent(int $id)
    {
        $notification = $this->model->findOrFail($id);
        $notification->status = $this->model::NOT_SENT;

        $notification->save();
    }
}
