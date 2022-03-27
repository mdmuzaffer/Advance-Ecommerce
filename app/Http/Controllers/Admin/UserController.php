<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use Excel;
use Carbon\Carbon;
use App\User;
use Session;
use DB;

class UserController extends Controller
{
    public function usersList(){
		Session::put('page','users');
		$userData = User::get()->toArray();
		return view('admin.users.users')->with(['controller'=>'user','users'=>$userData,'page_type'=>'admin_page']);
	}
	
	public function userStatus($id){
		//$userStatus = User::userStatus($id);
		$userStatus = json_decode(json_encode(User::userStatus($id)));
		$status = $userStatus[0]->status;
		
		$user = User::find($id);
		
		if($status ==0){
			$user->status = 1;
			$user->save();
			return back()->with('success','User status updated successfully !');
		}else{
			$user->status = 0;
			$user->save();
			return back()->with('success','User status updated successfully !');
		}
	}
	
	public function usersChart(){
		$curentMonth = User::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(0))->count();
		$curent_last_1_Month = User::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(1))->count();
		$curent_last_2_Month = User::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(2))->count();
		$curent_last_3_Month = User::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(3))->count();
		$curent_last_4_Month = User::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(4))->count();
		$curent_last_5_Month = User::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(5))->count();
		
		$month = array($curentMonth,$curent_last_1_Month,$curent_last_2_Month,$curent_last_3_Month,$curent_last_4_Month,$curent_last_5_Month);
		return view('admin.users.chart')->with(['controller'=>'user','page_type'=>'admin_page','monthUsers'=>$month]);
	
	}
	
	public function usersCountry(){
		$userlist = User::select('country', DB::raw('count(*) as total'))->groupBy('country')->get()->toArray();
		return view('admin.users.users_country_chart')->with(['controller'=>'user','userlist'=>$userlist]);
	}
	
	public function userExport(){
		return Excel::download(new UsersExport, 'users.xlsx');
	}
	
}
