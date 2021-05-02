<?php

namespace Database\Factories;

use App\Models\PayeeTransactionNotification;
use Illuminate\Database\Eloquent\Factories\Factory;

class PayeeTransactionNotificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PayeeTransactionNotification::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1
        ];
    }
}
