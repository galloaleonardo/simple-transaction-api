<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;

    const PERSON = 1;
    const COMPANY = 2;

    public function isPerson(): bool
    {
        return $this->id === self::PERSON;
    }

    public function isCompany(): bool
    {
        return $this->id === self::COMPANY;
    }
}
