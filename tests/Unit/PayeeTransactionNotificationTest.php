<?php

namespace Tests\Unit;

use App\Events\PayeeTransactionNotificationCreatedEvent;
use App\Models\PayeeTransactionNotification;
use Database\Factories\PersonFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PayeeTransactionNotificationTest extends TestCase
{
    use DatabaseTransactions;

    public function test_notification_created_event_is_fired()
    {
        $this->expectsEvents([PayeeTransactionNotificationCreatedEvent::class]);

        $person = PersonFactory::new()->create();

        PayeeTransactionNotification::factory()->create(
            ['user_id' => $person->id]
        );
    }
}
