<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\DateFormate;
use App\Rating;
use Session;
class RatingController extends Controller
{
	use DateFormate;
	
	public function ratingList(){
	
		//$rating = Rating::get()->toArray();
		$rating = Rating::with(['user','product'])->get()->toArray();
		Session::put('page','rating');
		return view('admin.rating.rating')->with(['controller'=>'rating','ratingData'=>$rating,'page_type'=>'admin_page']);
	}
	
	public function statusRating(Request $request){
		
		if($request->ajax()){
			$data = $request->all();
			$id = $data['id'];
			$status = $data['status'];
			if($status ==1){
				$statusvalue = 0;
			}else{
				$statusvalue = 1;
			}
			$Rating = Rating::find($id);
			$Rating->status = $statusvalue;
			$Rating->save();
			return response()->json(['status'=>200,'statusresponse'=>$statusvalue],200);
		}
		
	
	}
    
}
