<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use \Illuminate\Support\Str;


class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'user_type_id' => 1,
            'full_name' => 'Timmy Jones',
            'document' => 96790402080,
            'email' => 'timmy-jones@gmail.com',
            'password' => bcrypt(Str::random()),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'user_type_id' => 2,
            'full_name' => 'Amazon',
            'document' => 39150561000102,
            'email' => 'support@amazon.com',
            'password' => bcrypt(Str::random()),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
