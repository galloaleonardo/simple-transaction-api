<?php

namespace App\Events;

use App\Models\Transaction;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TransactionReceivedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Transaction $transaction;

    /**
     * Create a new event instance.
     *
     * @param  Transaction  $transaction
     */
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }
}
