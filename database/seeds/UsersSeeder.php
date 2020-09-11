<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'user_id' => 'matsui_eriko',
            'password' => Hash::make('hogehoge'),
            'access_token' => '',
            'name' => '松井恵理子',
            'del_flg' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
