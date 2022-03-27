<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\NewsletterSubscriber;
use App\Exports\subscriberExport;
//use Maatwebsite\Excel\Facades\Excel;
use Session;
use Excel;
class NewsletterSubscriberController extends Controller
{
    public function newsletterList(){
		Session::put('page','news-list');
		$dataList = NewsletterSubscriber::get()->toArray();
		return view('admin.newsletter.newsletter')->with(['controller'=>'NewsLetter','page_type'=>'admin_page','newsData'=>$dataList]);
		
	}
	
	public function newsUpdate(Request $request){
		$data = $request->all();
		$datafind = NewsletterSubscriber::find($data['id']);
		
		if(!empty($datafind)){
			
			$status = "";
			if($data['status'] ==0){
				$status =1;
			}else{
				$status =0;
			}
			$datafind->status = $status;
			$datafind->save();
			return response()->json(['status'=>200,'statusresponse'=>1],200);
			
		}else{
			return response()->json(['status'=>200,'statusresponse'=>0],200);
		}
	}
	
	public function newsDelete(Request $request,$id){
		$res = NewsletterSubscriber::where('id',$id)->delete();
		if($res){
			return back()->with('success','News Letter deleted successfully');
		}else{
			return back()->with('success','News Letter not deleted');
		}
	}
	
	public function exportnewsletterSubscribers(){
		return Excel::download(new subscriberExport,'subscriber.xlsx');
	}
}
