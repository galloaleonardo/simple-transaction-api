<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_types')->insert([
           'name' => 'Person',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('user_types')->insert([
            'name' => 'Company',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
