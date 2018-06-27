<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Admin::insert([
            'name' => 'singi',
            'email' => '787575327@qq.com',
            'password' => bcrypt('Singi2018@'),
        ]);
    }
}
