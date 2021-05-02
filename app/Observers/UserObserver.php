<?php

namespace App\Observers;

use App\Models\User;
use App\Services\WalletService;

class UserObserver
{
    private WalletService $walletService;

    public function __construct(WalletService $walletService)
    {
        $this->walletService = $walletService;
    }

    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $this->walletService->createWallet($user);
    }
}
