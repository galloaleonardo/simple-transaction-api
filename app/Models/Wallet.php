<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wallet extends Model
{
    use HasFactory;

    public function hasBalance(float $value): bool
    {
        return (float)$this->value >= $value;
    }

    public function user(): ?BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
