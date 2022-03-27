<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Brand;
use Session;

class BrandController extends Controller
{
    public function brands(){
		Session::put('page','brand');
		$brand = Brand::get();
		$brand = json_decode(json_encode($brand));
		//echo"<pre>";print_r($brand);die;
		return view('admin.brand.brands')->with(['controller'=>'brand','brands'=>$brand,'page'=>'brand']);
	}
	
	public function brandStatus(Request $request,$id =null){
		$Brand = Brand::find($id);
		$brandStatus = json_decode(json_encode($Brand));
		//echo"<pre>";print_r($brandStatus);die;
		if($brandStatus->status ==1){
			$status =0;
		}else{
			$status =1;
		}
		//$Brand = new Brand; this is not add in update query;
		$Brand->status = $status;
		$Brand->save();
		return back()->with('success','Brand status updated successfully!');
	}
	
	public function brandDelete($id){
		Brand::find($id)->delete();
		return back()->with('success','Your brand deleted successfully!');
	}
	
	public function brandAddEdit(Request $request,$id =null){
		if(!empty($id)){
			$title ="Edit Brand";
			$button ="Update Brand";
			//For update query
			$brand = Brand::find($id)->toArray();
			$message = "Brand updated successfully!";
		}else{
			$title ="Add Brand";
			$button ="Add Brand";
			$brand ="";
			$message = "Brand added successfully!";
		}
		if($request->isMethod('post')){
		$brandData = $request->all();
		//For save query
		$brand = new Brand;
		$brand->name = $brandData['brand'];
		$brand->status =1;
		$brand->save();
		return back()->with('success', $message);
		}
		return view('admin.brand.add_edit_brands')->with(['controller'=>'brand','title'=>$title,'button'=>$button,'id'=>$id,'brand'=>$brand]);
	}
}
