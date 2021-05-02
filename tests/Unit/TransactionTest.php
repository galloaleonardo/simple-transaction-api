<?php

namespace Tests\Unit;

use App\Events\TransactionAuthorizedEvent;
use App\Events\TransactionCreatedEvent;
use App\Events\TransactionReceivedEvent;
use App\Models\Transaction;
use Database\Factories\CompanyFactory;
use Database\Factories\PersonFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use DatabaseTransactions;

    public function test_transaction_created_event_is_fired()
    {
        $this->expectsEvents([TransactionCreatedEvent::class]);

        $person = PersonFactory::new()->create();
        $company = CompanyFactory::new()->create();

        Transaction::factory()->create(
            ['payer_id' => $person->id, 'payee_id' => $company->id]
        );
    }

    public function test_transaction_authorized_event_is_fired()
    {
        $this->expectsEvents([TransactionAuthorizedEvent::class]);

        $person = PersonFactory::new()->create();
        $company = CompanyFactory::new()->create();

        $transaction = Transaction::factory()->create(
            ['payer_id' => $person->id, 'payee_id' => $company->id]
        );

        $transaction->update(['status' => 'authorized']);
    }

    public function test_transaction_received_event_is_fired()
    {
        $this->expectsEvents([TransactionReceivedEvent::class]);

        $person = PersonFactory::new()->create();
        $company = CompanyFactory::new()->create();

        $transaction = Transaction::factory()->create(
            ['payer_id' => $person->id, 'payee_id' => $company->id]
        );

        $transaction->update(['status' => 'received']);
    }

    public function test_money_leaves_from_payer_when_transaction_is_pending()
    {
        $person = PersonFactory::new()->create();
        $company = CompanyFactory::new()->create();

        $walletBeforeTransaction = $person->wallet->value;

        Transaction::factory()->create(
            ['payer_id' => $person->id, 'payee_id' => $company->id]
        );

        $walletAfterTransaction = $person->wallet->fresh()->value;

        $this->assertTrue(
            $walletBeforeTransaction > $walletAfterTransaction
        );
    }

    public function test_money_returns_to_payer_when_transaction_is_cancelled()
    {
        $person = PersonFactory::new()->create();
        $company = CompanyFactory::new()->create();

        $transaction = Transaction::factory()->create(
            ['payer_id' => $person->id, 'payee_id' => $company->id]
        );

        $walletWhenPendingTransaction = $person->wallet->value;

        $transaction->update(['status' => 'cancelled']);

        $walletAfterCancelledTransaction = $person->wallet->fresh()->value;

        $this->assertTrue(
            $walletWhenPendingTransaction < $walletAfterCancelledTransaction
        );
    }

    public function test_payee_receives_money_when_transaction_success()
    {
        $person = PersonFactory::new()->create();
        $company = CompanyFactory::new()->create();

        $walletPayeeBeforeTransaction = $company->wallet->value;

        Transaction::factory()->create(
            ['payer_id' => $person->id, 'payee_id' => $company->id]
        );

        $walletPayeeAfterTransaction = $company->wallet->fresh()->value;

        $this->assertTrue(
            $walletPayeeBeforeTransaction < $walletPayeeAfterTransaction
        );
    }
}
