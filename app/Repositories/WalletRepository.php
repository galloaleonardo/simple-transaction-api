<?php

namespace App\Repositories;

use App\Models\Wallet;

class WalletRepository
{
    protected Wallet $model;

    public function __construct(Wallet $model)
    {
        $this->model = $model;
    }

    public function addBalance(int $id, float $value)
    {
        $wallet = $this->model->findOrFail($id);
        $wallet->value += $value;

        return $wallet->save();
    }

    public function subtractBalance(int $id, float $value)
    {
        $wallet = $this->model->findOrFail($id);
        $wallet->value -= $value;

        return $wallet->save();
    }

    public function returnsPayerBalance(int $id, float $value)
    {
        $wallet = $this->model->findOrFail($id);
        $wallet->value += $value;

        return $wallet->save();
    }
}
