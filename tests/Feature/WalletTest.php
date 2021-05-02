<?php

namespace Tests\Feature;

use Database\Factories\CompanyFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class WalletTest extends TestCase
{
    use DatabaseTransactions;

    public function test_wallet_is_created_when_a_new_user_is_inserted()
    {
        $user = CompanyFactory::new()->create();

        $this->assertDatabaseHas('wallets', ['user_id' => $user->id]);
    }
}
