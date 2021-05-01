<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayeeTransactionNotification extends Model
{
    use HasFactory;

    public const PENDING = 'pending';
    public const NOT_SENT = 'not-sent';
    public const SENT = 'sent';

    protected $guarded = [
        'created_at',
        'updated_at'
    ];
}
