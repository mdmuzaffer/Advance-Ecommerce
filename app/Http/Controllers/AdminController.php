<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Admin;
use DB;
use Image;
use Hash;
use Auth;
use Session;
class AdminController extends Controller
{
    public function adminUser(){
		return view('admin.index');
	}
	public function login(Request $request){
		//$password = Hash::make('admin@123');
		if($request->isMethod('post')){
			$data = $request->all();

		$rules = array(
			'email'=>'required|min:5',
			'password'=>'required|min:3',
		);

		 $messsages = array(
		'email.required'=>'Email field must required',
		'email.min'=>'Email field at list 5',
		'password.required'=>'Password field must required',
		'password.min'=>'Password alt list 3',
		);
		 $this->validate($request, $rules, $messsages);
			
			if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password']])){
				return redirect('/admin/dashboard');
			}else{
				return back()->with('error','Your Email or Password incorrect');
			}
		}
		return view('admin.login');
	}
	
	public function passwordChange(){
		Session::put('page','admin-password');
		$email = Auth::guard('admin')->user()->email;
		$adminData = Admin::where('email',$email)->get()->toArray();
		return view('admin.password')->with(['controller'=>'admin','adminData'=>$adminData,'page'=>'password','page_type'=>'admin_page']);
	}
	
	public function passwordSetting(Request $request){
		$newPassword = Hash::make($request->password);
		$name = $request->input('name');
		$email = Auth::guard('admin')->user()->email;
		$adminData = Admin::where('email',$email)->get()->toArray();
		$admonCount = Admin::where(['email'=>$email,'type'=>'admin','status'=>1,'name'=>$name])->count();
		if(Hash::check($request->currentPassword, Auth::guard('admin')->user()->password)){
			DB::table('admins')->where(['email'=>$email,'name'=>$name])->update(['password'=>$newPassword]);
			echo "Successfully password updated";
		}else{
			echo"Your current password is not match!";
		}
		
	}
	public function adminDetails(Request $request){
		Session::put('page','admin-details');
		$email = Auth::guard('admin')->user()->email;
		$adminData = Admin::where('email',$email)->get()->toArray();
		if($request->isMethod('post')){
			$data = $request->all();
			
			$ret = Validator::make($request -> input(), [
			'email' => 'required',
			'type' => 'required',
			'name' => 'required',
			'mobile' =>'required|min:11|numeric',
            'image' => 'mimes:jpeg,jpg,png | max:5'
			]);
			if($ret -> fails()){
		 	return Redirect('/admin/details')->withInput()->withErrors($ret);
			}else{
			$image = $request->file('image');
			$imageName = time().'.'.$image->getClientOriginalExtension();
			$path = "admin_images/".$imageName;
			Image::make($image)->resize('300','400')->save($path);
			
			//request()->image->move(public_path('/admin_images'), $imageName);
			
			DB::table('admins')->where(['email'=>$email])->update(['name'=>$data['name'],'mobile'=>$data['mobile'],'image'=>$imageName]);
			return back()->with('success','Your profile update successfully');
			
			}
			
		}
		
		return view('admin.details')->with(['controller'=>'admin','adminData'=>$adminData,'page'=>'details','page_type'=>'admin_page']);
	
	}
	public function adminLogout(){
		Auth::guard('admin')->logout();
		return redirect('/admin/login')->with('error','You are logout successfully !');
	}
	
}
