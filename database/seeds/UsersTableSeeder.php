<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //
        DB::table('users')->insert([
            'fname' => "Vijay",
            'lname' => "Vyas",
            'email' => "visicrux@gmail.com",
            'password' => bcrypt('admin123'),
            'status' => 1,
            'remember_token' => "",
        ]);
    }

}
