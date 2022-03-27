<?php

use Illuminate\Database\Seeder;
use App\Admin;
class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    DB::table('admins')->delete();
		$adminRecords =[
	['id'=>'1','name'=>'Admin','type'=>'admin','mobile'=>'7896541235','email'=>'admin@gmail.com','password'=>'$2y$10$TKTQy2s4nH30UtE7wy6BeuI7TFcuK8c687zg6tXY2QTcaOO18Bme6',
	'image'=>'NULL','status'=>'1'],
	['id'=>'2','name'=>'Muzaffer','type'=>'admin','mobile'=>'8546784512','email'=>'muzaffer@gmail.com','password'=>'$2y$10$Z6FNaveMc6aw/DqFBDrMiOU4d175yl4UaLdTeTMluDo13LjKK6Mo6',
	'image'=>'NULL','status'=>'1'],
	['id'=>'3','name'=>'shazidh','type'=>'subadmin','mobile'=>'8789456910','email'=>'shazidh@gmail.com','password'=>'$2y$10$Z6FNaveMc6aw/DqFBDrMiOU4d175yl4UaLdTeTMluDo13LjKK6Mo6',
	'image'=>'NULL','status'=>'0'],
		];
		DB::table('admins')->insert($adminRecords);
		//Admin::insert($adminRecords);
    }
}
