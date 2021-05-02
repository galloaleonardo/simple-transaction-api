<?php

namespace Tests\Feature;

use App\Models\Transaction;
use Database\Factories\CompanyFactory;
use Database\Factories\PersonFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use DatabaseTransactions;

    public function test_can_create_a_pending_transaction()
    {
        $this->withoutEvents();

        $person = PersonFactory::new()->create();
        $company = CompanyFactory::new()->create();

        $transaction = Transaction::factory()->make(
            [
                'payer_id' => $person->id,
                'payee_id' => $company->id
            ]
        )->toArray();

        $response = $this->post(route('transaction.store'), $transaction);

        $response->assertCreated();

        $this->assertDatabaseHas(
            'transactions',
            [
                'id'     => $response['data']['id'],
                'status' => 'pending'
            ]
        );
    }

    public function test_cannot_set_payer_as_a_company()
    {
        $this->withoutEvents();

        $person = PersonFactory::new()->create();
        $company = CompanyFactory::new()->create();

        $transaction = Transaction::factory()->make(
            [
                'payer_id' => $company->id,
                'payee_id' => $person->id
            ]
        )->toArray();

        $response = $this->post(route('transaction.store'), $transaction);

        $response->assertStatus(422);
    }

    public function test_cannot_do_a_transaction_without_balance()
    {
        $this->withoutEvents();

        $person = PersonFactory::new()->create();
        $company = CompanyFactory::new()->create();

        $transaction = Transaction::factory()->make(
            [
                'payer_id' => $person->id,
                'payee_id' => $company->id,
                'value'    => 10000000000
            ]
        )->toArray();

        $response = $this->post(route('transaction.store'), $transaction);

        $response->assertStatus(422);
    }

    public function test_cannot_do_a_transaction_with_invalid_payer()
    {
        $this->withoutEvents();

        $company = CompanyFactory::new()->create();

        $transaction = Transaction::factory()->make(
            [
                'payer_id' => 99999,
                'payee_id' => $company->id
            ]
        )->toArray();

        $response = $this->post(route('transaction.store'), $transaction);

        $response->assertStatus(422);
    }

    public function test_cannot_do_a_transaction_with_invalid_payee()
    {
        $this->withoutEvents();

        $person = PersonFactory::new()->create();

        $transaction = Transaction::factory()->make(
            [
                'payer_id' => $person->id,
                'payee_id' => 99999
            ]
        )->toArray();

        $response = $this->post(route('transaction.store'), $transaction);

        $response->assertStatus(422);
    }

    public function test_cannot_do_transaction_for_yourself()
    {
        $this->withoutEvents();

        $person = PersonFactory::new()->create();

        $transaction = Transaction::factory()->make(
            [
                'payer_id' => $person->id,
                'payee_id' => $person->id
            ]
        )->toArray();

        $response = $this->post(route('transaction.store'), $transaction);

        $response->assertStatus(422);
    }

    public function test_cannot_possible_set_null_in_required_fields()
    {
        $transaction = Transaction::factory()->make(
            [
                'payer_id' => null,
                'payee_id' => null,
                'value'    => null
            ]
        )->toArray();
        $response = $this->post(route('transaction.store'), $transaction);

        $response->assertStatus(422);
    }
}
