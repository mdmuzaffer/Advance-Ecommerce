<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Country;
use App\State;
use App\Cart;
use App\Sms;
use Session;
use Validator;
use Auth;
use DB;
class UsersController extends Controller
{
    public function loginRegister(){
		return view('front.users.users_login')->with(['controller'=>'users','page_type'=>'front_page']);
	}
	
	public function usersRegister(Request $request){
		if($request->isMethod('post')){
		$data = $request->all();
		$userCount = User::where('email',$data['email'])->count();
			if($userCount >0){
			return back()->with('error','Already added this email id');
			}else{
				$user = new User;
				$user->name = $data['name'];
				$user->mobile = $data['mobile'];
				$user->email = $data['email'];
				$user->password = bcrypt($data['password']);
				$user->status = 0;
				$user->save();
				
				//mail confirmation send
				$email = $data['email'];
				$messageData =[
					'name'=>$data['name'],
					'email'=>$data['email'],
					'code' =>base64_encode($data['email'])
				];
				Mail::send('front.email.users_confirmation', $messageData, function($message) use($email){
					$message->to($email)->subject('Confirm Your E-commerce Account!');
				});
				return back()->with('success','Please confirm your email to active account !');
				
				
				/* if (Auth::attempt(['email' =>$data['email'], 'password' =>$data['password'], 'status' =>1])){
					$message ="Dear Customer, You have been successfully register with E-commerce website.Login to your account to access order and available offers.";
					$mobile = $data['mobile'];
					//Sms::sendSms($message,$mobile);
					$email = $data['email'];
					$messageData =['name'=>$data['name'],'mobile'=>$data['mobile'],'email'=>$data['email']];
					Mail::send('front.email.users_register', $messageData, function($message) use($email){
						$message->to($email)->subject('Welcome to E-commerce of Muzaffer!');
					});
					
					return redirect('/');
				} */
			}
		}
	}
	
	// user Login
	public function usersLogin(Request $request){
		if($request->isMethod('post')){
			$data = $request->all();
			$request->validate([
				'loginemail' => 'required',
				'loginpassword' => 'required',
			]);
			
			if (Auth::attempt(['email' =>$data['loginemail'], 'password' =>$data['loginpassword']])){
					
					//check email activated
					$userStatus = User::where('email',$data['loginemail'])->first()->toArray();
					if($userStatus['status'] ==0){
						Auth::logout();
						return back()->with('errorlogin','Your account not activated Please confirm your email to active');
					}else{
						if(!empty(Session::get('session_id'))){
							$session_id = Session::get('session_id');
							$user_id = Auth::user()->id;
							Cart::where('session_id',$session_id)->update(['user_id'=>$user_id]);
						}
						return redirect('/cart');
					}
			}else{
				return back()->with('errorlogin','Email address or Password is wrong');
			}
			
		}
	}
	
	//Account cofirm
	public function accountCofirm($email){
		$userEmail = base64_decode($email);
		$userConf = User::where('email',$userEmail)->first()->toArray();
		if($userConf['status'] ==0){
			User::where('email',$userConf['email'])->update(['status'=>1]);
			//send email 
			$message ="Dear Customer, You have been successfully register with E-commerce website.Login to your account to access order and available offers.";
			$email = $userConf['email'];
			$messageData =['name'=>$userConf['name'],'mobile'=>$userConf['mobile'],'email'=>$userConf['email']];
			
			Mail::send('front.email.users_register', $messageData, function($message) use($email){
				$message->to($email)->subject('Welcome to E-commerce of Muzaffer!');
			});
			return redirect('/login-register')->with('success','Your account activated successfully for login!');
			
		}else{
			return redirect('/login-register')->with('errorlogin','Your account already activated !');
		}
	
	}
	
	//users Logout
	public function usersLogout(){
		Auth::logout();
		return redirect('/');
	}
	
	//user email validation jquery remote method
	public function emailCheck(Request $request){
		$data = $request->all();
		$userCount = User::where('email',$data['email'])->count();
			if($userCount >0){
			echo 'false';
			}else{
			  echo 'true';
			}
	}
	// forgot Password
	public function forgotPassword(Request $request){
		if($request->isMethod('post')){
			$data = $request->all();
			$forgetCount = User::where('email',$data['email'])->count();
			if($forgetCount ==0){
				return back()->with('error','Email address not found !');
			}else{
			
				$updatePassword = str_random(5);
				$newPassword = bcrypt($updatePassword);
				User::where('email',$data['email'])->update(['password'=>$newPassword]);
				$userforgot = User::where('email',$data['email'])->first()->toArray();
				
				//send email 
				$message ="Request for forgot recovery password";
				$email = $userforgot['email'];
				$messageData =['name'=>$userforgot['name'],'password'=>$updatePassword,'email'=>$userforgot['email']];
				Mail::send('front.email.forgot_password', $messageData, function($message) use($email){
					$message->to($email)->subject('Recovery Password E-commerce!');
				});
				return back()->with('success','Your password recovered check in mail!');
			}
			
		}
	return view('front.users.forgot_password');
	}
	
	public function myAccount(Request $request){
	
		$country = Country::all()->toArray();
		$state = State::all()->toArray();
		
		if($request->isMethod('post')){
		$mydata = $request->all();
		$this->validate($request, [
			'name' => 'required|min:3',
			'address' => 'required',
			'city' => 'required',
			'state' => 'required',
			'country' => 'required',
			'pin' => 'required',
			'mobile' => 'required|min:10|numeric',
			'email' => 'required|email',
		]);
		
		$userId = Auth::user()->id;
		$user = User::find($userId);
		$user->name = $mydata['name'];
		$user->address = $mydata['address'];
		$user->city = $mydata['city'];
		$user->state = $mydata['state'];
		$user->country = $mydata['country'];
		$user->pincode = $mydata['pin'];
		$user->mobile = $mydata['mobile'];
		$user->save();
		return back()->with('success','Your account details updated!');
		}
		return view('front.users.my_account')->with(['controller'=>'users','page_type'=>'front_page','country'=>$country,'state'=>$state]);
	}
	public function passwordChange(Request $request){
		if($request->isMethod('post')){
			$pwddata = $request->all();
			
			if (!(Hash::check($request->get('password'), Auth::user()->password))) {
            // The passwords matches
				return redirect()->back()->with("errorpwd","Your current password does not matches with the password you provided. Please try again.");
			}
			if(strcmp($request->get('password'), $request->get('newpassword')) == 0){
            //Current password and new password are same
				return redirect()->back()->with("errorpwd","New Password cannot be same as your current password. Please choose a different password.");
			}
			$validatedData = $request->validate([
				'password' => 'required|same:password',
				'newpassword' => 'required',
				'confirmpassword' => 'required|same:newpassword', 
			]);
			//Change Password
			$user = Auth::user();
			$user->password = bcrypt($request->get('newpassword'));
			$user->save();
			return redirect()->back()->with("successpwd","Password changed successfully !");

		}
	}
	
	public function testMail(){

		//send email 
			$message ="Dear Customer, You have test mail";
			$email = "mddemo2021@yopmail.com";
			$messageData =['name'=>'test user','mobile'=>'789654123','email'=>'testmailuser@gmail.com'];
			
			Mail::send('front.email.users_register', $messageData, function($message) use($email){
				$message->to($email)->subject('Welcome to E-commerce of Muzaffer!');
			});
	
	}
	
}
