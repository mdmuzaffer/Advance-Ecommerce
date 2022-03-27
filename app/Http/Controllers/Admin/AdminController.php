<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Admin;
use App\AdminsRole;
use DB;
use Image;
use Hash;
use Auth;
use Session;
class AdminController extends Controller
{
    public function adminUser(){
		Session::put('page','dashboard');
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
	
	public function adminList(){
		Session::put('page','adminrole');
		$adminData = Auth::guard('admin')->user()->get()->toArray();
		return view('admin.admin.users')->with(['controller'=>'admin','adminData'=>$adminData,'page'=>'Admin','page_type'=>'admin_page']);
		
	}
	
	public function adminAddedit(Request $request,$id =null){
		
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
		 	return back()->withInput()->withErrors($ret);
			}else{
				
				if(!empty($id)){
					$admin = Admin::find($id);
					$message = "User details updated successfully";
				}else{
					$admin = new Admin;
					$message = "New user added successfully";
				}
			
			$admin->name = $data['name'];
			$admin->email = $data['email'];
			$admin->type = $data['type'];
			$admin->password = Hash::make($data['password']);
			$admin->mobile = $data['mobile'];
			$admin->status = 1;
			
			$image = $request->file('image');
			$imageName = time().'.'.$image->getClientOriginalExtension();
			$path = "admin_images/".$imageName;
			Image::make($image)->resize('300','400')->save($path);
			$admin->image = $imageName;
			$admin->save();
			return back()->with('success',$message);
				
			}
		}
		
		
		if(!empty($id)){
			$title ="Update Admin";
			$button ="Update";
			$adminData = Admin::get()->where('id',$id)->first()->toArray();
		}else{
			$title ="Add Admin";
			$button ="Add User";
			$adminData ="";
		}
		return view('admin.admin.add_edit')->with(['controller'=>'admin','adminData'=>$adminData,'title'=>$title,'button'=>$button]);
	}
	
	public function roleStatus(Request $request,$id){
		$statusData = Admin::find($id);
		if($statusData->status ==0){
			$statusData->status =1;
		}else{
			$statusData->status =0;
		}
		$statusData->save();
		return back()->with('success','Admin profile role update successfully');
	}
	
	public function roleDelete(Request $request,$id){
		$adminImg = Admin::where('id',$id)->first()->toArray();
		if(!empty($adminImg['image'])){
			$adminImgPath ="admin_images/";
			if(file_exists($adminImgPath.$adminImg['image']))
			unlink($adminImgPath.$adminImg['image']);
		}
		Admin::where('id',$id)->delete();
		return back()->with('success','Admin deleted successfully');
	}
	
	public function rolePermission(Request $request,$id =Null){

			//$admonroleData = AdminsRole::get()->where('admin_id',$id)->toArray();
			$admonroleData = AdminsRole::where('admin_id',$id)->get()->toArray();
			
			if(!empty($admonroleData)){
				$message = "Permission update successfully";
				$title ="Admin Permission";
				$button ="Update";
			
			}else{
			
				$message = "Permission added successfully";
				$title ="Admin Permission";
				$button ="Add";
				$admonroleData = "";
				//$id= $id;
				//$adRole = new AdminsRole;
			}
			
			//
			if($request->isMethod('post')){
				AdminsRole::where('admin_id',$id)->delete();
				$data = $request->all();
				unset($data['_token']);
				unset($data['user_id']);
				
				/* echo"<pre>";
				print_r($data);
				die; */
				
				foreach($data as $key=>$value){
					
					if(isset($value['view'])){
						$view = $value['view'];
					}else{
						$view =0;
					}
					
					if(isset($value['edit'])){
						$edit = $value['edit'];
					}else{
						$edit =0;
					}
					
					if(isset($value['full'])){
						$full = $value['full'];
					}else{
						$full =0;
					}
					
					/* $adRole->admin_id = $id;
					$adRole->model = $key;
					$adRole->view_access = $view;
					$adRole->edit_access = $edit;
					$adRole->full_access = $full;
					$adRole->save(); */
					
					DB::table('admins_roles')->insert([
						'admin_id' => $id,
						'model' => $key,
						'view_access' => $view,
						'edit_access' => $edit,
						'full_access' => $full,
					]);
					
				}
				return back()->with('success', $message);
			}
			
	
		return view('admin.admin.admin_permission')->with(['controller'=>'admin','admonroleData'=>$admonroleData,'title'=>$title,'button'=>$button,'id'=>$id,'page_type'=>'admin_page']);
	}
	
}
