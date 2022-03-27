<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class IndexController extends Controller
{
    public function index(){
		$productsCount = Product::where('is_featured', 'Yes')->count();
		if($productsCount >0){
			$featureProduct = Product::where(['is_featured'=>'Yes'])->get();
			$featureProduct = json_decode(json_encode($featureProduct));
			$featureProduct = array_chunk($featureProduct, 4,true);
			
			//display Lastest products
			$latestProduct = Product::orderBy('id','DESC')->limit(6)->get();
			$latestProduct = json_decode(json_encode($latestProduct));
			//echo "<pre>";print_r($latestProduct);die;
		}
		return view('front.index')->with(['controller'=>'index','page_type'=>'front_page','featureProduct'=>$featureProduct,'latestProduct'=>$latestProduct,'productsCount'=>$productsCount]);
	}
}
