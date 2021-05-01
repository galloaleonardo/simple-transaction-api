<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    public const PENDING = 'pending';
    public const AUTHORIZED = 'authorized';
    public const CANCELLED = 'cancelled';
    public const FINISHED = 'finished';

    protected $guarded = [
        'created_at',
        'updated_at'
    ];

    public function payer(): ?BelongsTo
    {
        return $this->belongsTo(User::class, 'payer_id', 'id');
    }

    public function payee(): ?BelongsTo
    {
        return $this->belongsTo(User::class, 'payee_id', 'id');
    }

    public function authorized(): bool
    {
        return $this->status === self::AUTHORIZED;
    }

    public function cancelled(): bool
    {
        return $this->status === self::CANCELLED;
    }

}
