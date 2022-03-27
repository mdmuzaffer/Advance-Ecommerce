<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Coupon;
use App\User;
use App\Section;
use Session;

use App\AdminsRole;
use Auth;

class CouponsController extends Controller
{
    public function coupons(){
		Session::put('page','coupons');
		$couponData = Coupon::all()->toArray();
		
		// added code for page access
		$couponModule = AdminsRole::where(['admin_id'=>Auth::guard('admin')->user()->id,'model'=>'coupon'])->count();
		if(isset($couponModule) && $couponModule==0){
			return back()->with('success','You are not accessible for this coupon page');
		}else{
			$couponAccess = AdminsRole::where(['admin_id'=>Auth::guard('admin')->user()->id,'model'=>'coupon'])->get()->toArray();
		}
		
		return view('admin.coupons.coupon')->with(['controller'=>'coupons', 'coupon'=>$couponData,'page_type'=>'admin_page','couponAccess'=>$couponAccess]);
	}
	
	// coupons status change
	public function couponStatus(Request $request){
		$couponStatus = $request->all();
		if($couponStatus['status'] ==1){
			Coupon::where('id',$couponStatus['id'])->update(['status'=>0]);
		}else{
			Coupon::where('id',$couponStatus['id'])->update(['status'=>1]);
		}
		$coupon = Coupon::find($couponStatus['id'])->toArray();
		return response()->json(['status'=>$coupon['status']]);
	}
	
	public function couponAddEdit(Request $request, $id =null){
		if($id ==""){
			$button = "Submit";
			$title = "Add Coupons";
			$categorie = Section::with('categories')->get();
			$categories = json_decode(json_encode($categorie));
			$usersData = User::select('email')->where('status',1)->get()->toArray();
			$coupon = new Coupon;
			$couponData =[];
			$message = "Your Coupon added successfully!";
		}else{
			$button = "Update";
			$title = "Edit Coupon";
			$categorie = Section::with('categories')->get();
			$categories = json_decode(json_encode($categorie));
			$usersData = User::select('email')->where('status',1)->get()->toArray();
			$couponData1 = Coupon::get()->where('id',$id)->first();
			$couponData = json_decode(json_encode($couponData1));
			$coupon = Coupon::findOrFail($id);
			$message = "Your coupon updated successfully!";
		}
		if($request->isMethod('post')){
			$dataCoupon = $request->all();
			$rules = [
				'coupon_option' => 'required',
				'coupon_type' => 'required',
				'amount_type' => 'required',
				'amount' => 'required',
				'date' => 'required',
				'users' => 'required',
				'category' => 'required',
			];
			$customMessages = [
				'coupon_option.required' => 'Please select coupon option !',
				'coupon_type.required' => 'Please select coupon type !',
				'amount_type.required' => 'Please select amount option !',
				'amount.required' => 'Please add amount !',
			];
			$this->validate($request, $rules, $customMessages);
			
			if($dataCoupon['coupon_option'] =="Automatic"){
				$couponCode = str_random(8);
			}
			if($dataCoupon['coupon_option'] =="Manually"){
				$couponCode = $dataCoupon['manually_coupon'];
			}
			if(isset($dataCoupon['users'])){
				$users = implode(',',$dataCoupon['users']);
			}
			if(isset($dataCoupon['category'])){
				$category = implode(',',$dataCoupon['category']);
			}
			$coupon->coupon_option = $dataCoupon['coupon_option'];
			$coupon->coupon_code = $couponCode;
			$coupon->categories = $category;
			$coupon->users = $users;
			$coupon->coupon_type = $dataCoupon['coupon_type'];
			$coupon->amount_type = $dataCoupon['amount_type'];
			$coupon->amount = $dataCoupon['amount'];
			$coupon->expery_date = $dataCoupon['date'];
			$coupon->status = 1;
			$coupon->save();
			return back()->with('success',$message);
		}
		return view('admin.coupons.coupon_form')->with(['controller'=>'coupons', 'couponData'=>$couponData, 'users'=>$usersData, 'categories'=>$categories, 'title'=>$title, 'button'=>$button,'page_type'=>'admin_page']);
	}
	
	//delete coupon
	public function couponDelete($id =null){
		Coupon::where('id', $id)->delete();
		return back()->with('success','Your coupon deleted successfully');
	}
	
}
