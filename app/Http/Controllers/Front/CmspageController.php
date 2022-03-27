<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\CmsPage;

class CmspageController extends Controller
{
    public function cmsPages(Request $request){
		$current_url = $request->path();
		$CmsUrl = CmsPage::select('url')->where('status',1)->get()->pluck('url')->toArray();
			
		if(in_array($current_url, $CmsUrl)){
			$CmsPageData = CmsPage::where('url',$current_url)->where('status',1)->first()->toArray();
			return view('front.pages.cms_page')->with(['controller'=>'cmspage','pageData'=>$CmsPageData]);
		}
		
	}
	
	public function cmsPagesContact(Request $request){
		$title = "Visit us";
		if($request->isMethod('post')){
			$data = $request->all();
			$email = $data['email'];
			$message = $data['message'];
			
			$messageData =[
					'email'=>$email,
					'name'=>$data['name'],
					'comment'=>$message,
					'subject'=>$data['subject']
				];
				
				Mail::send('front.email.contact_us', $messageData, function($message) use($email){
					$message->to($email)->subject('Contact Us - E-commerce of Muzaffer!');
				});
				

				
			return back()->with('success','Your contact us message sent successfully');
		}
		return view('front.pages.contact_page')->with(['controller'=>'cmspage','title'=>$title]);
	}
}
