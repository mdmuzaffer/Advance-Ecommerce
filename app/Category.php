<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Category extends Model
{
	use Notifiable;
	//public $timestamps = false;
	protected $fillable = [
        'parent_id', 'section_id', 'category_name','category_image','category_discount','description','url','meta_title','meta_description','meta_keywords','status',
    ];
	
	//sub categories
	public function subcategories(){
	   return $this->hasMany('App\Category', 'parent_id')->where('status',1);
   }
   //select the section
   public function section(){
	   return $this->belongsTo('App\Section', 'section_id')->select('id','name');
   }
   //select the parent category
   public function parentCategory(){
	   return $this->belongsTo('App\Category', 'parent_id')->select('id','category_name');
   }
   
   public static function categoryDetails($url){
	   $categoryDetails = Category::select('id','category_name','url','description')->with('subcategories')->where('url',$url)->first()->toArray();
	   $catsId =[];
	   $catsId[] = $categoryDetails['id'];
	   
	   foreach($categoryDetails['subcategories'] as $subcat){
		    $catsId[] = $subcat['id'];
		}
		return $catDetails = ['categoryDetails'=>$categoryDetails,'catsId'=>$catsId];
	}
}
