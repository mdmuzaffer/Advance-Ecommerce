<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('users')->delete();
	$usersRecords =[
			['id'=>'1','name'=>'Admin','email'=>'admin@gmail.com','password'=>'$2y$10$TKTQy2s4nH30UtE7wy6BeuI7TFcuK8c687zg6tXY2QTcaOO18Bme6','remember_token'=>'nNUm9Bwn0OdNo3QJooJzVhmlUGyPAMpYKP9fy42iMwDcK65QEITu9MYOJwoV',],
			//['id'=>'1','name'=>'Admin','email'=>'admin@gmail.com','password'=>'$2y$10$TKTQy2s4nH30UtE7wy6BeuI7TFcuK8c687zg6tXY2QTcaOO18Bme6','remember_token'=>'nNUm9Bwn0OdNo3QJooJzVhmlUGyPAMpYKP9fy42iMwDcK65QEITu9MYOJwoV',],
		];
		
	User::insert($usersRecords);
	//DB::table('users')->insert($usersRecords);
    }
}
