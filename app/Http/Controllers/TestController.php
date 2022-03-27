<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function contact(){
		return view('test.contact');
	}
	
	 public function testData(Request $request){
		print_r($request->all());
		echo"test data here";
	 }
}
