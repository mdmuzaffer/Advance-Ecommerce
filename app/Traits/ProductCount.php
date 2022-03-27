<?php

namespace App\Traits;
use App\Product;
trait ProductCount
{

   function CatProductCount($catId){
	//Trails only work in controller
	   //return $data = "This is the test";
	   return Product::where(['category_id'=>$catId,'status'=>1])->count();
    }

}
