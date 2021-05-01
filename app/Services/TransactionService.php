<?php

namespace App\Services;

use App\Models\Transaction;
use App\Repositories\TransactionRepository;

class TransactionService
{
    protected TransactionRepository $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function getAll(): array
    {
        return $this->transactionRepository->getAll();
    }

    public function save(array $data): array
    {
        return $this->transactionRepository->save($data);
    }

    public function setAuthorized(Transaction $transaction)
    {
        $this->transactionRepository->setAuthorized($transaction->id);
    }

    public function setCancelled(Transaction $transaction)
    {
        $this->transactionRepository->setCancelled($transaction->id);
    }

    public function setReceived(Transaction $transaction)
    {
        $this->transactionRepository->setReceived($transaction->id);
    }

    public function setFinished(Transaction $transaction)
    {
        $this->transactionRepository->setFinished($transaction->id);
    }
}
