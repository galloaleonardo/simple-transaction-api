<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\User;
use App\Repositories\WalletRepository;

class WalletService
{
    protected WalletRepository $walletRepository;

    public function __construct(WalletRepository $walletRepository)
    {
        $this->walletRepository = $walletRepository;
    }

    public function addPayeeBalance(Transaction $transaction)
    {
        $idWallet = $transaction->payee->wallet->id;
        $value = $transaction->value;

        return $this->walletRepository->addBalance($idWallet, $value);
    }

    public function subtractPayerBalance(Transaction $transaction)
    {
        $idWallet = $transaction->payer->wallet->id;
        $value = $transaction->value;

        return $this->walletRepository->subtractBalance($idWallet, $value);
    }

    public function returnsPayerBalance(Transaction $transaction)
    {
        $idWallet = $transaction->payer->wallet->id;
        $value = $transaction->value;

        $this->walletRepository->returnsPayerBalance($idWallet, $value);
    }

    public function createWallet(User $user)
    {
        $this->walletRepository->create($user->id);
    }

}
