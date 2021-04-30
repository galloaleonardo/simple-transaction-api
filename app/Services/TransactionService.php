<?php

namespace App\Services;

use App\Repositories\TransactionRepository;

class TransactionService
{
    protected TransactionRepository $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function save(array $data): array
    {
        return $this->transactionRepository->save($data);
    }
}
