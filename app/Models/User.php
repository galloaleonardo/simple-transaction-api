<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Model
{
    use HasFactory;

    public const PERSON = 'person';
    public const COMPANY = 'company';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    public function isPerson(): bool
    {
        return $this->user_type === self::PERSON;
    }

    public function isCompany(): bool
    {
        return $this->user_type === self::COMPANY;
    }

    public function wallet(): ?HasOne
    {
        return $this->hasOne(Wallet::class, 'user_id', 'id');
    }
}
