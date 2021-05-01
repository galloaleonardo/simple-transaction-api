<?php

namespace App\Repositories;

use App\Models\Transaction;

class TransactionRepository
{
    protected Transaction $model;

    public function __construct(Transaction $model)
    {
        $this->model = $model;
    }

    public function getAll(): array
    {
        return $this->model->all()->toArray();
    }

    public function save(array $data): array
    {
        if ($transaction = $this->model->create($data)) {
            return $transaction->toArray();
        }

        return [];
    }

    public function setAuthorized(int $id): void
    {
        $transaction = $this->model->findOrFail($id);
        $transaction->status = $this->model::AUTHORIZED;

        $transaction->save();
    }

    public function setCancelled(int $id): void
    {
        $transaction = $this->model->findOrFail($id);
        $transaction->status = $this->model::CANCELLED;

        $transaction->save();
    }

    public function setReceived(int $id): void
    {
        $transaction = $this->model->findOrFail($id);
        $transaction->status = $this->model::RECEIVED;

        $transaction->save();
    }

    public function setFinished(int $id): void
    {
        $transaction = $this->model->findOrFail($id);
        $transaction->status = $this->model::FINISHED;

        $transaction->save();
    }
}
