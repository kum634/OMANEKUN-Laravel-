<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
//シーダーを使用する
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('users')
        ->insert([
          'id' => NULL,
          'name' => 'guest',
          'email' => 'u.kei0424@gmail.com',
          'password' => bcrypt('guest2020')
        ]);
    }
}
