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

    public function save(array $data): array
    {
        if ($transaction = $this->model->create($data)) {
            return $transaction->toArray();
        }

        return [];
    }
}
