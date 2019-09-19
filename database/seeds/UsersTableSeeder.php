<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        DB::table('users')->insert([
            0 => [
                'name' => 'Yickson Ramirez',
                'email' => 'yicksonr@gmail.com',
                'password' => bcrypt('casa2468'),
                'type' => 'admin'
            ]
        ]);
    }
}
