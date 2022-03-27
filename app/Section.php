<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public function categories(){
		return $this->hasMany('App\Category','section_id')->where(['parent_id'=>0,'status'=>1])->with('subcategories');
	}
	
	public static function sections(){
		$getSection = Section::with('categories')->where('status',1)->get();
		return $getSection = json_decode(json_encode($getSection));
		//echo"<pre>";print_r($getSection);echo"</pre>";
	}
}
