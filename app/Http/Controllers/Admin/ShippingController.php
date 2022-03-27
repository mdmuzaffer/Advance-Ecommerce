<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ShippingCharge;
use Session;

class ShippingController extends Controller
{
	function shippingCharge(){
		Session::put('page','shipping');
		$shippingCharge = ShippingCharge::get()->toarray();
		return view('admin.shipping_charge.shipping')->with(['controller'=>'shipping','shippingCharge'=>$shippingCharge,'page_type'=>'admin_page']);
	}
	
	public function shippingChargeUpdate(Request $request, $id){
		$shippingData = ShippingCharge::find($id)->toarray();
		if($request->isMethod('post')){
		
			$data = $request->all();
			$charge = ShippingCharge::find($id);
			ShippingCharge::where('id',$id)->update(['0_500g'=>$data['0_500g'],'501_1000g'=>$data['501_1000g'],'1001_2000g'=>$data['1001_2000g'],'20001_5000g'=>$data['20001_5000g'],'above_5000g'=>$data['above_5000g']]);
			return back()->with('success', 'Your shipping charge updated successfully');
		}
		return view('admin.shipping_charge.update_shipping')->with(['controller'=>'shipping','shippingData'=>$shippingData,'title'=>'shipping charge','button'=>'charge','page_type'=>'admin_page']);
	}
	
	public function shippingStatus(Request $request){
		$data = $request->all();
		$id = $data['id'];
		$shipStatus = ShippingCharge::find($id);
		$shippingStatus = ShippingCharge::find($id)->toArray();
		
		if($shippingStatus['status'] ==1){
			$shipStatus->status = 0;
			$shipStatus->save();
			return response()->json(['status' =>400, 'message' => 'Status updated successfully']);
		}else{
			$shipStatus->status =1;
			$shipStatus->save();
			return response()->json(['status' =>200, 'message' => 'Status updated successfully']);
		}
	}
}
