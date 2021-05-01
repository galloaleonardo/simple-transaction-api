<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserWalletSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wallets')->insert([
            'user_id' => 1,
            'value' => 1000,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('wallets')->insert([
            'user_id' => 2,
            'value' => 5000,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
