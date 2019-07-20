<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'password' => bcrypt('secret'),
            'admin_user' => 1,
        ]);
        DB::table('users')->insert([
            'username' => 'test1',
            'password' => bcrypt('test')
        ]);
        DB::table('users')->insert([
            'username' => 'test2',
            'password' => bcrypt('test')
        ]);
    }
}
