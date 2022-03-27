<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\NewsletterSubscriber;

class NewsletterSubscriberController extends Controller
{
    public function newsletter(Request $request){
		if($request->ajax()){
			$data = $request->all();
			$NewsletterSubscriber = new NewsletterSubscriber;
			$NewsletterSubscriber->email = $data['email'];
			$NewsletterSubscriber->status = 0;
			$NewsletterSubscriber->save();
			return response()->json(['status'=>200,'message'=>'Your have subscribed successfully'],200);
			
		}
	}
}
