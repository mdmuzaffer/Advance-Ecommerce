<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    public static function getBanner(){
		$bannerData = Banner::where('status',1)->get()->toArray();
		return $bannerData;
	}
}
