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
        DB::table('roles')->insert([
        	['id'=>1, 'name' => 'admin','display_name' => 'Admin',],
        	['id'=>2, 'name' => 'member','display_name' => 'Member',],
        ]);
		
        DB::table('users')->insert([
        	['id'=>1, 'name' => 'admin','email' => 'lcyoong@gmail.com', 'password'=>bcrypt('aabbccdd')],
        ]);
		
        DB::table('role_user')->insert([
        	['user_id'=>1, 'role_id' => 1],
        ]);
		
    }
}
